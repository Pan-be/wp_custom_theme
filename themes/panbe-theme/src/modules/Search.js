// import $ from 'jquery';

// class Search {
//     // 1 describe and create/initiate obj
//     constructor() {
//         this.addSearchHTML();
//         this.resultDiv = $('#search-overlay__results')
//         this.openButton = $("#search");
//         this.closeButon = $(".search-overlay__close");
//         this.searchOverlay = $(".search-overlay");
//         this.searchField = $("#search-field");
//         this.events();
//         this.isOverlayOpen = false;
//         this.isSpinnerVisible = false;
//         this.typingTimer;
//         this.previousValue;
//     }

//     // 2 events
//     events() {
//         this.openButton.on('click', this.openOverlay.bind(this));
//         this.closeButon.on('click', this.closeOverlay.bind(this));
//         $(document).on('keyup', this.keyPressDispatcher.bind(this));
//         this.searchField.on('keyup', this.typingLogic.bind(this));
//     }

//     // 3 methods
//     typingLogic() {
//         if (this.searchField.val() != this.previousValue) {
//             clearTimeout(this.typingTimer);

//             if (this.searchField.val()) {
//                 if (!this.isSpinnerVisible) {
//                     this.resultDiv.html('<div class="spinner-loader"></div>');
//                     this.isSpinnerVisible = true;
//                 }
//                 this.typingTimer = setTimeout(this.getResults.bind(this), 750);

//             } else {
//                 this.resultDiv.html('');
//                 this.isSpinnerVisible = false;
//             }

//         }
//         this.previousValue = this.searchField.val()
//     }

//     getResults() {
//         $.getJSON(panbe_data.root_url + '/wp-json/panbe/v1/search?term=' + this.searchField.val(), (results) => {
//             this.resultDiv.html(`
//                 <div class="container">
//                     <div class="row">
//                         <div class="card" style="width: 18rem;">
//                             <div class="card-body">
//                                 <h5 class="card-title">General Information</h5>

//                             </div>
//                             ${results.generalInfo.length ? '<ul class="list-group list-group-flush">' : '<ul class="list-group list-group-flush"><li class="list-group-item">No general information matches that search :(</li></ul>'}
//                             ${results.generalInfo.map(results => `<li class="list-group-item"><a href="${results.premalink}">${results.title}</a> ${results.postType == 'post' ? `by ${results.authorName}` : ''}</li>`).join('')}
//                             ${results.generalInfo.length ? '</ul>' : ''}
//                         </div>
//                         <div class="card" style="width: 18rem;">
//                             <div class="card-body">
//                                 <h5 class="card-title">Programs</h5>

//                             </div>
//                             ${results.programs.length ? '<ul class="list-group list-group-flush">' : `<ul class="list-group list-group-flush"><li class="list-group-item">No programs match that search. <a href="${panbe_data.root_url}/programs">View all programs</a></li></ul>`}
//                             ${results.programs.map(results => `<li class="list-group-item"><a href="${results.premalink}">${results.title}</a></li>`).join('')}
//                             ${results.programs.length ? '</ul>' : ''}

//                         </div>
//                         <div class="card" style="width: 18rem;">
//                             <div class="card-body">
//                                 <h5 class="card-title">Tutorials</h5>

//                             </div>

//                             ${results.tutorials.length ? '<ul class="list-group list-group-flush">' : `<ul class="list-group list-group-flush"><li class="list-group-item">No tutorials match that search. <a href="${panbe_data.root_url}/tutorials">View all tutorials</a></li></ul>`}
//                             ${results.tutorials.map(results => `<li class="list-group-item"><a href="${results.premalink}">${results.title}</a></li>`).join('')}
//                             ${results.tutorials.length ? '</ul>' : ''}
//                         </div>
//                         <div class="card" style="width: 18rem;">
//                             <div class="card-body">
//                                 <h5 class="card-title">Tutors</h5>

//                             </div>

//                             ${results.tutors.length ? '<ul class="list-group list-group-flush">' : `<ul class="list-group list-group-flush"><li class="list-group-item">No tutor match that search.</li></ul>`}
//                             ${results.tutors.map(result => `
//                                 <li class="card" style="width: 18rem;">
//             <a href="${result.premalink}">
//                 <img src="${result.img}" class="card-img-top" alt="...">
//                 <div class="card-body">
//                     <h5 class="card-title">${result.title}</h5>

//                 </div>
//             </a>
//         </li>
//                                 `).join('')}
//                             ${results.tutors.length ? '</ul>' : ''}
//                         </div>
//                         </div>
//                         </div>
//                 `)
//         })


//         // $.when(
//         //     $.getJSON(panbe_data.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()),
//         //     $.getJSON(panbe_data.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())
//         // )
//         //     .then((posts, pages) => {
//         //         const results = posts[0].concat(pages[0])
//         //         this.resultDiv.html(`
//         //             <h2 class="search-overlay__section-title">General Information</h2>
//         //              ${results.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search :(</p>'}
//         //              ${results.map(results => `<li><a href="${results.link}">${results.title.rendered}</a> ${results.type == 'post' ? `by ${results.authorName}` : ''}</li>`).join('')}
//         //              ${results.length ? '</ul>' : ''}
//         //             `)
//         //     }, () => {
//         //         this.resultDiv.html('<p>Unexpected error.</p>')
//         //     })

//         this.isSpinnerVisible = false;
//     }

//     openOverlay() {
//         this.searchOverlay.addClass("search-overlay--active");
//         $("body").addClass("body-no-scroll");
//         this.isOverlayOpen = true;
//         setTimeout(() => {
//             this.searchField.focus();
//         }, 300);
//         return false
//     }

//     closeOverlay() {
//         this.searchOverlay.removeClass("search-overlay--active");
//         $("body").removeClass("body-no-scroll");
//         this.isOverlayOpen = false;
//         this.searchField.val('');
//         this.resultDiv.html('')
//     }

//     keyPressDispatcher(e) {

//         if (e.keyCode == 83 && !this.isOverlayOpen && !$('input, textarea').is(':focus')) {
//             this.openOverlay();
//         }

//         if (e.keyCode == 27 && this.isOverlayOpen) {
//             this.closeOverlay()
//         }
//     }

//     addSearchHTML() {
//         $('body').append(`
//             <div class="search-overlay">
//     <div class="search-overlay__top">
//         <div class="container">
//             <svg class="search-overlay__icon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
//                 viewBox="0 0 50 50">
//                 <path style="fill:#FF8C00 "
//                     d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z">
//                 </path>
//             </svg>
//             <input type="text" class="search-term" placeholder="What are you looking for?" id="search-field"
//                 autocomplete="off">
//             <svg class="search-overlay__close" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
//                 viewBox="0 0 50 50">
//                 <path fill="#ffffff"
//                     d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z">
//                 </path>
//             </svg>
//         </div>
//     </div>
//     <div class="containter">
//         <div id="search-overlay__results"></div>
//     </div>
// </div>
// `)
//     }

// }

// export default Search


class Search {
    // 1 describe and create/initiate obj
    constructor() {
        this.addSearchHTML();
        this.resultDiv = document.getElementById('search-overlay__results');
        this.openButton = document.getElementById('search');
        this.closeButton = document.querySelector('.search-overlay__close');
        this.searchOverlay = document.querySelector('.search-overlay');
        this.searchField = document.getElementById('search-field');
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.typingTimer;
        this.previousValue;
    }

    // 2 events
    events() {
        this.openButton.addEventListener('click', this.openOverlay.bind(this));
        this.closeButton.addEventListener('click', this.closeOverlay.bind(this));
        document.addEventListener('keyup', this.keyPressDispatcher.bind(this));
        this.searchField.addEventListener('keyup', this.typingLogic.bind(this));
    }

    // 3 methods
    typingLogic() {
        if (this.searchField.value != this.previousValue) {
            clearTimeout(this.typingTimer);

            if (this.searchField.value) {
                if (!this.isSpinnerVisible) {
                    this.resultDiv.innerHTML = '<div class="spinner-loader"></div>';
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 750);

            } else {
                this.resultDiv.innerHTML = '';
                this.isSpinnerVisible = false;
            }

        }
        this.previousValue = this.searchField.value;
    }

    getResults() {
        fetch(`${panbe_data.root_url}/wp-json/panbe/v1/search?term=${this.searchField.value}`)
            .then(response => response.json())
            .then(results => {
                this.resultDiv.innerHTML = `
                <div class="container">
                    <div class="row">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">General Information</h5>
                                
                            </div>
                            ${results.generalInfo.length ? '<ul class="list-group list-group-flush">' : '<ul class="list-group list-group-flush"><li class="list-group-item">No general information matches that search :(</li></ul>'}
                            ${results.generalInfo.map(result => `<li class="list-group-item"><a href="${result.premalink}">${result.title}</a> ${result.postType == 'post' ? `by ${result.authorName}` : ''}</li>`).join('')}
                            ${results.generalInfo.length ? '</ul>' : ''}
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Programs</h5>
                                
                            </div>
                            ${results.programs.length ? '<ul class="list-group list-group-flush">' : `<ul class="list-group list-group-flush"><li class="list-group-item">No programs match that search. <a href="${panbe_data.root_url}/programs">View all programs</a></li></ul>`}
                            ${results.programs.map(result => `<li class="list-group-item"><a href="${result.premalink}">${result.title}</a></li>`).join('')}
                            ${results.programs.length ? '</ul>' : ''}
  
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Tutorials</h5>
                                
                            </div>
                           
                            ${results.tutorials.length ? '<ul class="list-group list-group-flush">' : `<ul class="list-group list-group-flush"><li class="list-group-item">No tutorials match that search. <a href="${panbe_data.root_url}/tutorials">View all tutorials</a></li></ul>`}
                            ${results.tutorials.map(result => `<li class="list-group-item"><a href="${result.premalink}">${result.title}</a></li>`).join('')}
                            ${results.tutorials.length ? '</ul>' : ''}
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Tutors</h5>
                                
                            </div>
                           
                            ${results.tutors.length ? '<ul class="list-group list-group-flush">' : `<ul class="list-group list-group-flush"><li class="list-group-item">No tutor match that search.</li></ul>`}
                            ${results.tutors.map(result => `
                                <li class="card" style="width: 18rem;">
                                    <a href="${result.premalink}">
                                        <img src="${result.img}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">${result.title}</h5>
                                        </div>
                                    </a>
                                </li>
                            `).join('')}
                            ${results.tutors.length ? '</ul>' : ''}
                        </div>
                    </div>
                </div>`;
            });

        this.isSpinnerVisible = false;
    }

    openOverlay() {
        this.searchOverlay.classList.add("search-overlay--active");
        document.body.classList.add("body-no-scroll");
        this.isOverlayOpen = true;
        setTimeout(() => this.searchField.focus(), 300);
        return false;
    }

    closeOverlay() {
        this.searchOverlay.classList.remove("search-overlay--active");
        document.body.classList.remove("body-no-scroll");
        this.isOverlayOpen = false;
        this.searchField.value = '';
        this.resultDiv.innerHTML = '';
    }

    keyPressDispatcher(e) {
        if (e.keyCode === 83 && !this.isOverlayOpen && !document.querySelector('input:focus, textarea:focus')) {
            this.openOverlay();
        }

        if (e.keyCode === 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    addSearchHTML() {
        document.body.insertAdjacentHTML('beforeend', `
            <div class="search-overlay">
                <div class="search-overlay__top">
                    <div class="container">
                        <svg class="search-overlay__icon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                            viewBox="0 0 50 50">
                            <path style="fill:#FF8C00 "
                                d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z">
                            </path>
                        </svg>
                        <input type="text" class="search-term" placeholder="What are you looking for?" id="search-field"
                            autocomplete="off">
                        <svg class="search-overlay__close" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                            viewBox="0 0 50 50">
                            <path fill="#ffffff"
                                d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="container">
                    <div id="search-overlay__results"></div>
                </div>
            </div>
        `);
    }
}

export default Search;
