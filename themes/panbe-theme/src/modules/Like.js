import axios from "axios"
const tutorBox = document.querySelector('.tutor-content-box')

class Like {
    constructor() {
        if (tutorBox) {
            this.events()
        }
    }

    events() {
        tutorBox.addEventListener('click', e => {
            if (e.target.closest('.like-box')) {
                this.ourClickDispatcher(e)
            }
        })
    }


    //methods
    ourClickDispatcher(e) {
        const currentLikeBox = e.target.closest('.like-box')
        if (currentLikeBox.dataset.exist === 'yes') {
            this.deleteLike(currentLikeBox)
        } else {
            this.createLike(currentLikeBox)
        }
    }

    async manageLike(action, data) {
        try {
            axios.defaults.headers.common["X-WP-Nonce"] = panbe_data.nonce
            const response = await axios({
                method: action,
                url: panbe_data.root_url + "/wp-json/panbe/v1/manageLike",
                data: data
            })

            console.log(response.data)
            return response.data
        }
        catch (e) {
            console.log(e)
        }
        finally {

        }
    }

    async createLike(currentLikeBox) {
        const likeData = await this.manageLike('post', { 'tutorId': currentLikeBox.dataset.tutor })
        let likeCount = parseInt(currentLikeBox.querySelector('#like-count').textContent, 10);
        likeCount++;
        currentLikeBox.querySelector('#like-count').textContent = likeCount;
        console.log(likeCount)
        currentLikeBox.dataset.exist = 'yes'
        currentLikeBox.dataset.like = likeData
    }
    async deleteLike(currentLikeBox) {
        await this.manageLike('delete', { 'like': currentLikeBox.getAttribute('data-like') })
        let likeCount = parseInt(currentLikeBox.querySelector('#like-count').textContent, 10);
        likeCount--;
        currentLikeBox.querySelector('#like-count').textContent = likeCount;
        console.log(likeCount)
        currentLikeBox.dataset.exist = 'no'
        currentLikeBox.dataset.like = ''
    }
}

export default Like;