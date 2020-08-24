<template>
    <div class="container">
        <form action="" v-on:submit.prevent="newTweet()">
            <div class="form-group">
                <label for="">What are you thinking today?</label>
                <input type="text" class="form-control" name="tweet"
                v-model="content">
            </div>
            <div class="my-2">
                <v-btn type="submit" color="primary">Publish</v-btn>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            content: ''
        }
    },
    mounted () {
        console.log('Form component Mounted')
    },
    methods: {
        newTweet() {
            const args = {
                content: this.content
            }
            this.content = ''
            
            axios.post('/api/tweets', args)
            .then((response) => {
                const tweet = response.data
                this.$emit('new', tweet)
            })
            
        }
    }
}
</script>
