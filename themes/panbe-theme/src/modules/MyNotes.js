import axios from "axios"

const newNoteForm = document.querySelector("#new-note");
const warningText = document.querySelector('.warning-text');

class MyNotes {
    constructor() {
        if (document.querySelector("#my-notes")) {
            axios.defaults.headers.common["X-WP-Nonce"] = panbe_data.nonce
            this.myNotes = document.querySelector("#my-notes")
            this.events()
        }
    }
    events() {
        this.myNotes.addEventListener('click', e => {
            if (e.target.closest('.remove-note-button')) {
                this.deleteNote(e)
            }
            if (e.target.closest('.edit-note-button')) {
                this.editNote(e)
            }
            if (e.target.closest('.back-button')) {
                this.cancelEditing(e)
            }
            if (e.target.closest('.save-note-button')) {
                this.updateNote(e)
            }
        })
        newNoteForm.addEventListener('submit', e => this.saveNewNote(e))
    }

    // Methods

    async editNote(e) {
        const thisNote = e.target.closest("li");
        const noteTitleField = thisNote.querySelector(".note-title-field");
        const noteBodyField = thisNote.querySelector(".note-body-field");
        const editButton = thisNote.querySelector(".edit-note-button");
        const editModeButtons = thisNote.querySelector(".edit-mode-buttons");

        const noteElements = { noteTitleField, noteBodyField, editButton, editModeButtons }

        this.makeNoteEditable(noteElements)

    }

    makeNoteEditable({ noteTitleField, noteBodyField, editButton, editModeButtons }) {
        if (noteTitleField) {
            noteTitleField.removeAttribute("readonly");
            noteTitleField.classList.add("note-active-field");
        }
        if (noteBodyField) {
            noteBodyField.removeAttribute("readonly");
            noteBodyField.classList.add("note-active-field");
        }

        if (editButton) {
            editButton.toggleAttribute("hidden")
        }
        if (editModeButtons) {
            editModeButtons.toggleAttribute("hidden");
            editModeButtons.classList.toggle("d-flex")
        }

    }

    cancelEditing(e) {

        const thisNote = e.target.closest("li");
        const noteTitleField = thisNote.querySelector(".note-title-field");
        const noteBodyField = thisNote.querySelector(".note-body-field");
        const editButton = thisNote.querySelector(".edit-note-button");
        const editModeButtons = thisNote.querySelector(".edit-mode-buttons");

        if (noteTitleField) {
            noteTitleField.setAttribute("readonly", "readonly");
            noteTitleField.classList.remove("note-active-field");
        }
        if (noteBodyField) {
            noteBodyField.setAttribute("readonly", "readonly");
            noteBodyField.classList.remove("note-active-field");
        }

        if (editButton) {
            editButton.toggleAttribute("hidden")
        }
        if (editModeButtons) {
            editModeButtons.toggleAttribute("hidden");
            editModeButtons.classList.toggle("d-flex")
        }

    }

    async deleteNote(e) {

        const thisNote = e.target.closest("li")

        try {
            const noteId = thisNote.getAttribute('data-id')
            const response = await axios.delete(panbe_data.root_url + "/wp-json/wp/v2/note/" + noteId)

            if (parseInt(response.data.userNoteCount, 10) < 5) {
                warningText.toggleAttribute("hidden")
            }
        } catch (e) {
            console.log('sorry')
        } finally {
            thisNote.style.transition = "height 0.5s ease, opacity 0.5s ease";
            thisNote.style.height = 0;
            thisNote.style.opacity = 0;

            // Usuwamy element z DOM po zakończeniu animacji
            setTimeout(() => {
                thisNote.remove();
            }, 500);
            console.log('deleted')

        }
    }

    async updateNote(e) {

        const thisNote = e.target.closest("li")
        const updatedPost = {
            'title': thisNote.querySelector('.note-title-field').value,
            'content': thisNote.querySelector('.note-body-field').value
        }

        try {
            const noteId = thisNote.getAttribute('data-id')
            const response = await axios.post(panbe_data.root_url + "/wp-json/wp/v2/note/" + noteId, updatedPost)
        } catch (e) {
            console.log('sorry')
        } finally {
            this.cancelEditing(e)
            console.log('updated')
        }
    }

    async saveNewNote(e) {
        e.preventDefault()
        const formFields = {
            title: document.querySelector('#new-note-title').value,
            content: document.querySelector('#new-note-body').value
        }
        // const thisNote = e.target.closest("li")
        const newPost = {
            'title': formFields.title,
            'content': formFields.content,
            'status': 'publish'
        }

        try {

            const response = await axios.post(panbe_data.root_url + "/wp-json/wp/v2/note/", newPost)
            console.log(response)
            // Utwórz element <li>
            if (response.data === "You have reached your note limit.") {
                warningText.removeAttribute("hidden")
            } else {
                this.renderNewNote(response)

                document.querySelector('#new-note-title').value = ''
                document.querySelector('#new-note-body').value = ''
            }
        } catch (e) {
            console.log('sorry', e)
        } finally {

            console.log('updated')
        }
    }

    renderNewNote(response) {
        const li = document.createElement('li');
        li.classList.add('list-group-item');
        li.setAttribute('data-id', response.data.id);

        // Stwórz zawartość elementu <li>
        li.innerHTML = `
    <div class="input-group mb-3">
        <button class="btn btn-light note-control-btn edit-note-button" type="button">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="128px" height="128px"
                viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve">
                <g>
                    <g>
                        <path d="M8,112V16c0-4.414,3.594-8,8-8h80c4.414,0,8,3.586,8,8v47.031l8-8V16c0-8.836-7.164-16-16-16H16C7.164,0,0,7.164,0,16v96
c0,8.836,7.164,16,16,16h44v-8H16C11.594,120,8,116.414,8,112z M88,24H24v8h64V24z M88,40H24v8h64V40z M88,56H24v8h64V56z M24,80
h32v-8H24V80z M125.656,72L120,66.344c-1.563-1.563-3.609-2.344-5.656-2.344s-4.094,0.781-5.656,2.344l-34.344,34.344
C72.781,102.25,68,108.293,68,110.34L64,128l17.656-4c0,0,8.094-4.781,9.656-6.344l34.344-34.344
C128.781,80.188,128.781,75.121,125.656,72z M88.492,114.82c-0.453,0.43-2.02,1.488-3.934,2.707l-10.363-10.363
c1.063-1.457,2.246-2.922,2.977-3.648l25.859-25.859l11.313,11.313L88.492,114.82z" />
                    </g>
                </g>
            </svg>
        </button>
        <div hidden class="edit-mode-buttons flex-column">
            <button class="btn btn-light note-control-btn save-note-button" type="button">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32"
                    style="enable-background:new 0 0 32 32;" xml:space="preserve" width="128px"
                    height="128px">
                    <g>
                        <g>
                            <path style="fill:#010002;"
                                d="M26,0h-2v13H8V0H0v32h32V6L26,0z M28,30H4V16h24V30z" />
                            <rect x="6" y="18" style="fill:#010002;" width="20" height="2" />
                            <rect x="6" y="22" style="fill:#010002;" width="20" height="2" />
                            <rect x="6" y="26" style="fill:#010002;" width="20" height="2" />
                            <rect x="18" y="2" style="fill:#010002;" width="4" height="9" />
                        </g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                </svg>
            </button>
            <button class="btn btn-light note-control-btn back-button">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                </svg>
            </button>
        </div>
        <div>
            <input readonly class="note-title-field" value="${response.data.title.raw}">
            <textarea readonly class="note-body-field">${response.data.content.raw}</textarea>
        </div>
        <button class="btn btn-danger note-control-btn remove-note-button" type="button">
            <svg height="137px" style="enable-background:new 0 0 98 137;" version="1.1"
                viewBox="0 0 98 137" width="98px" xml:space="preserve"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <path fill="white"
                    d="M75.6,44.8v73c0,3.4-2.8,6.2-6.2,6.2H21.3c-3.4,0-6.2-2.8-6.2-6.2v-73H75.6L75.6,44.8z M59.9,52.9v62.8h3.6V52.9H59.9 L59.9,52.9z M43.6,52.9v62.8h3.6V52.9H43.6L43.6,52.9z M27.3,52.9v62.8h3.6V52.9H27.3L27.3,52.9z M31.3,27.9v-5.2 c0-3.3,2.6-5.9,5.9-5.9h16.4c3.3,0,5.9,2.6,5.9,5.9v5.2h18.1c3.4,0,6.2,2.8,6.2,6.2v4.3H7V34c0-3.4,2.8-6.2,6.2-6.2H31.3L31.3,27.9z M37.2,20.8c-1,0-1.8,0.8-1.8,1.8v5.2h20.1v-5.2c0-1-0.8-1.8-1.8-1.8H37.2L37.2,20.8z" />
                <rect fill="none" height="137" id="_x3C_Slice_x3E__100_" width="98" />
            </svg>
        </button>
    </div>
`;

        // Dodaj element <li> do listy na początku
        const myNotes = document.getElementById('my-notes');
        myNotes.insertBefore(li, myNotes.firstChild);

        // Ukryj element, a następnie pokaż go z animacją
        li.style.display = 'none';
        setTimeout(() => {
            li.style.display = 'block';
            li.style.transition = 'height 0.5s ease-out';
            li.style.height = 'auto';
        }, 0);
    }

}

export default MyNotes;