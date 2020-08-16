<template>
    <div class="container">
        <div class="panel-body">
            <input v-if="editMode" type="text"
            v-model="tweet.content">
            <p v-else>{{ tweet.content }}</p>
        </div>
        <div class="panel-footer">
            <button class="btn btn-default"
            v-on:click="tweetUpdate()"
            v-if="editMode">
                Update
            </button>
            <button class="btn btn-default"
            v-on:click="tweetEdit()"
            v-else>
                Edit
            </button>
            <button class="btn btn-default"
            v-on:click="tweetDelete()">
                Delete
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['tweet'],
    data () {
        return {
            editMode: false
        }
    },
    mounted () {
        console.log('Tweet component Mounted')
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
        }
    }
}
</script>
