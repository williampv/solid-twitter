<template>
    <div class="container">
        <div class="row justify-content-center">
            <input type="text">
            <button>Publish</button>
        </div>
        <tweet-component v-for="tweet in tweets" :key="tweet.id" :tweet="tweet">
        </tweet-component>
    </div>
</template>

<script>
export default {
    data () {
        return {
            info: null,
            tweets: [{
                'id': 1,
                'content': 'First tweet'
            }]
        }
    },

    mounted() {
        axios
            .get('http://127.0.0.1:8000/api/tweets')
            .then(response => (this.info = response.data))
    }
}
</script>
