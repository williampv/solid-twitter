<template>
    <div>
        <info-component :id="id"></info-component>

        <form-component @new="addTweet"></form-component>
        
        <tweet-component 
        v-for="(tweet, index) in tweets" 
        :key="tweet.id" 
        :tweet="tweet"
        @delete="deleteTweet(index)"
        @update="updateTweet(index, ...arguments)">
        </tweet-component>
    </div>
</template>

<script>
export default {
    props: ['id'],
    data () {
        return {
            tweets: [],
        }
    },

    mounted() {
        axios.get(`/api/tweets/${this.id}`)
            .then(response => (this.tweets = response.data))
    },

    methods: {
        addTweet(tweet) {
            this.tweets.push(tweet)
        },
        deleteTweet(index) {
            this.tweets.splice(index, 1)
        },
        updateTweet(index, tweet) {
            this.tweets[index] = tweet
        }
    }
}
</script>
