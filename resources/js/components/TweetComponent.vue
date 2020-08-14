<template>
    <div class="container">
        <div>
            {{ tweet.content }}
        </div>
    </div>
</template>

<script>
export default {
    props: ['tweet'],

    mounted () {
        console.log('Tweet component Mounted')
    }
}
</script>
