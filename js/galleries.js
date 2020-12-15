var map;
//google map API
function initMap() {
    var x = document.getElementsByClassName("c");
    map = new google.maps.Map(x[0], {
        center: { lat: 41.89474, lng: 12.4839 },
        zoom: 18,
        mapTypeId: 'satellite'

    });
    console.log(map);
}

document.addEventListener("DOMContentLoaded", function () {

    //URL API
    // const galleryAPI = "https://www.randyconnolly.com/funwebdev/3rd/api/art/galleries.php"
    // const paintingAPITemp = "https://www.randyconnolly.com/funwebdev/3rd/api/art/paintings.php?gallery="
    const galleryAPI = "https://asg2test.herokuapp.com/api-galleries.php"
    const paintingAPITemp = "https://asg2test.herokuapp.com/api-paintings.php?GalleryID="
    //arrays 
    const gallery = retrieveStorage();
    let paintings = [];
    let gallID = 0;
    //global variable of the table since so many other functions rely on it
    const tab = document.querySelector('#tab');


    //event handlers
    setUpListOfGallHandler()
    setUpSingleViewHandler()
    // setUpButtonHandler()
    // setUpBigViewHandler()
    // setUpCloseBigViewHandler()
    // setUpPlusHandler()
    // setUpMinusHandler()
    sortArtist()
    sortTitle()
    sortYear()

    localStorage.removeItem('data');

    //First inital fetch gets the list of galleries 
    if (gallery.length <= 0) {
        console.log("s")
        fetch(galleryAPI)
            .then(repsonse => repsonse.json())
            .then((data) => {
                gallery.push(...data),
                    updateStorage(),
                    popNav()
            })
            .catch(err => console.log(err))
    }
    else {
        popNav();
    }

    //Populates the navigation bar with list of galleries
    function popNav() {
        list = document.querySelector('#gallList')
        for (g of gallery) {
            console.log(gallery)
            li = document.createElement('li')
            li.textContent = g.GalleryName
            list.appendChild(li)
        }
    }

    function updateStorage() {
        localStorage.setItem('data', JSON.stringify(gallery))
    }

    function retrieveStorage() {
        return JSON.parse(localStorage.getItem('data')) || [];
    }


    //When user selects a gallery from nav bar
    function setUpListOfGallHandler() {
        let oldE;
        document.querySelector('#gallList').addEventListener('click', function (e) {
            for (g of gallery) {
                if (e.target.textContent == g.GalleryName && e.target.nodeName == "LI") {
                    paintingAPI = paintingAPITemp + g.GalleryID
                    console.log(paintingAPI)
                    //Keeps track of what gallery is selected and changes CSS style
                    e.target.style.backgroundColor = "#5c7287";
                    if (oldE != undefined) {
                        oldE.target.removeAttribute('style')
                    }
                    oldE = e
                    gallID = g.GalleryID;
                }
            }
            //fetches gallery selected an populates the gallery info, map and painting table
            fetch(paintingAPI)
                .then(repsonse => repsonse.json())
                .then((data) => {
                    paintings = [];
                    paintings.push(...data),
                        popGallInfo(),
                        popMap(),
                        popPaintings()
                })
                .catch(err => console.log(err))
        }
        )
    }

    //populates the gallery info
    function popGallInfo() {
        for (let g of gallery) {
            if (g.GalleryID == gallID) {
                document.querySelector('#galleryName').textContent = g.GalleryName;
                document.querySelector('#galleryNative').textContent = g.GalleryNativeName;
                document.querySelector('#galleryCity').textContent = g.GalleryCity;
                document.querySelector('#galleryAddress').textContent = g.GalleryAddress;
                document.querySelector('#galleryCountry').textContent = g.GalleryCountry;
                document.querySelector('#galleryWeb').textContent = g.GalleryWebSite;
                document.querySelector('#galleryWeb').setAttribute('href', g.GalleryWebSite);
            }
        }

    }
    //populates the Google Map
    function popMap() {
        for (let g of gallery) {
            if (g.GalleryID == gallID) {
                console.log("asefas");
                map.setCenter(new google.maps.LatLng(g.Latitude, g.Longitude))
            }
        }
    }
    //initalizes the paintings to be displayed by sorting by the artist last name
    //then calling the displayPaint() to populate the painting table
    function popPaintings() {
        tab.innerHTML = ""
        const artist = paintings.sort((a, b) => {
            return a.LastName < b.LastName ? -1 : 1;
        })
        displayPaint(artist)
    }
    //populates the painting table and recieves the sorted array 
    function displayPaint(sort) {
        tab.innerHTML = ""
        for (let i of sort) {
            tr = document.createElement('tr');
            img = document.createElement('img')
            img.setAttribute('src', "https://res.cloudinary.com/funwebdev/image/upload/w_75/art/paintings/" + i.FullImageFileName)
            tdA = document.createElement('td')
            tdA.appendChild(img)
            tdB = document.createElement('td')
            tdB.textContent = i.LastName
            tdC1 = document.createElement('td')
            tdC = document.createElement('a')
            tdC.textContent = i.Title
            tdC.setAttribute('href', "https://asg2test.herokuapp.com/redirect.php?PaintingId=" + i.PaintingId)
            tdC.setAttribute('id', i.PaintingId)
            tdC.setAttribute('alt', i.Title)
            tdC.setAttribute('class', i.LastName)
            tdD = document.createElement('td')
            tdD.textContent = i.YearOfWork

            tr.appendChild(tdA)
            tr.appendChild(tdB)
            tr.appendChild(tdC)
            tr.appendChild(tdD)
            tab.appendChild(tr)
        }
    }
    //sorts the painting array by artist last name
    function sortArtist() {
        document.querySelector('#artH').addEventListener('click', function (e) {
            const artist = paintings.sort((a, b) => {
                return a.LastName < b.LastName ? -1 : 1;
            })
            displayPaint(artist);
        })
    }
    //sorts the painting array by title
    function sortTitle() {
        document.querySelector('#titleH').addEventListener('click', function (e) {
            const title = paintings.sort((a, b) => {
                return a.Title < b.Title ? -1 : 1;
            })
            displayPaint(title);
        })
    }
    //sorts the painting array by year
    function sortYear() {
        document.querySelector('#yearH').addEventListener('click', function (e) {
            const year = paintings.sort((a, b) => {
                return a.YearOfWork < b.YearOfWork ? -1 : 1;
            })
            displayPaint(year);
        })
    }

    //displays single painting view when user clicks the title painting in the table
    function setUpSingleViewHandler() {
        document.querySelector('#paintTable').addEventListener('click', function (e) {
            console.log(e.target.getAttribute('id'));
        })
    }

})
