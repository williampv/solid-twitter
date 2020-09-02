<template>
    <v-container>
        <v-card class="tweet_card">
            <v-card-title>
                <router-link :to="'/profile/'+tweet.user_id">
                    <img class="card-img-top" src="https://365psd.com/images/istock/previews/1009/100996291-male-avatar-profile-picture-vector.jpg" alt="Card image" style="max-width: 40px">
                </router-link>
                <router-link :to="'/profile/'+tweet.user_id">
                    <p style="margin-bottom: 0">&nbsp;{{ userName }}</p>
                </router-link>
            </v-card-title>
            <v-card-text>
                <input v-if="editMode" type="text" class="form-control" v-model="tweet.content">
                <p v-else>{{ tweet.content }}</p>
            </v-card-text>
            <v-card-actions>
                <v-btn color="blue"
                v-on:click="tweetUpdate()"
                v-if="editMode">
                    Update
                </v-btn>
                <v-btn color="blue"
                v-on:click="tweetEdit()"
                v-else 
                :disabled="userDisable">
                    Edit
                </v-btn>
                <v-btn color="error" 
                v-on:click="tweetDelete()"
                :disabled="userDisable">
                    Delete
                </v-btn>
                <v-btn color="yellow"
                v-on:click="deleteLike()"
                v-if="like">
                    Dislike
                </v-btn>
                <v-btn color="pink"
                v-on:click="newLike()"
                v-else>
                    Like
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
export default {
    props: ['tweet'],
    data () {
        return {
            editMode: false,
            like: false,
            accountId: '',
            userName: '',
            userDisable: false
        }
    },

    mounted () {
        console.log('Tweet component Mounted')
        axios.get(`/api/account`)
        .then((response) => {
            //console.log("ACCOUNT: ", response)
            this.accountId = response.data.id
            
            if(this.tweet.user_id != this.accountId) {
                this.userDisable = true
            }
            
            axios.get(`/api/tweets/${this.tweet.id}/like/${this.accountId}`)
            .then((response) => {
                if(response.data != '') {
                    this.like = true
                } else {
                    this.like = false
                }
            })
        })

        axios.get(`/api/users/${this.tweet.user_id}/like`)
        .then((response) => {
            this.userName = response.data.name
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

<style scoped>
.tweet_card {
    min-width: 500px;
    padding: 15px
}
</style>
