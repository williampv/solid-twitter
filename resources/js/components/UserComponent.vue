<template>
    <div>
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
    data () {
        return {
            tweets: []
        }
    },

    mounted() {
        axios.get(`/api/tweets/show`)
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
