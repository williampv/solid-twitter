<template>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <router-link :to="'/profile/'+tweet.user_id">
                    <img class="card-img-top" src="https://365psd.com/images/istock/previews/1009/100996291-male-avatar-profile-picture-vector.jpg" alt="Card image" style="max-width: 40px">
                </router-link>
                <p>User: {{ tweet.user_id }}</p>
                <input v-if="editMode" type="text" class="form-control"
                v-model="tweet.content">
                <p v-else>{{ tweet.content }}</p>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-info"
                v-on:click="tweetUpdate()"
                v-if="editMode">
                    Update
                </button>
                <button type="button" class="btn btn-success"
                v-on:click="tweetEdit()"
                v-else>
                    Edit
                </button>
                <button type="button" class="btn btn-danger"
                v-on:click="tweetDelete()">
                    Delete
                </button>
                <button type="button" class="btn btn-warning"
                v-on:click="deleteLike()"
                v-if="like">
                    Dislike
                </button>
                <button type="button" class="btn btn-success"
                v-on:click="newLike()"
                v-else>
                    Like
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['tweet'],
    data () {
        return {
            editMode: false,
            like: false,
            accountId: ''
        }
    },

    mounted () {
        console.log('Tweet component Mounted')
        axios.get(`/api/account`)
        .then((response) => {
            //console.log("ACCOUNT: ", response)
            this.accountId = response.data.id
            axios.get(`/api/tweets/${this.tweet.id}/like/${this.accountId}`)
            .then((response) => {
                if(response.data != '') {
                    this.like = true
                } else {
                    this.like = false
                }
            })
        })
        

    },

    methods: {
        tweetDelete () {
            axios.delete(`/api/tweets/${this.tweet.id}`)
            .then(() => {
                this.$emit('delete')
            })
        },
        tweetEdit () {
            this.editMode = true
        },
        tweetUpdate () {
            const args = {
                content: this.tweet.content
            }
            axios.put(`/api/tweets/${this.tweet.id}`, args)
            .then((response) => {
                this.editMode = false
                const tweet = response.data;
                this.$emit('update', tweet)
            }) 
        },
        newLike () {
            const args = {
                user_id: this.accountId
            }
            axios.post(`/api/tweets/${this.tweet.id}/like`, args)
            .then((response) => {
                this.like = true
            })
        },

        deleteLike () {
            axios.delete(`/api/tweets/${this.tweet.id}/like/${this.accountId}`)
            .then(() => {
                this.like = false
            })
        }
    }
}
</script>
