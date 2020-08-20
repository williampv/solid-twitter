<template>
    <div class="container">
        <div class="card" style="width:400px; margin: 0 auto; align-items: center;">
            <img class="card-img-top" src="https://365psd.com/images/istock/previews/1009/100996291-male-avatar-profile-picture-vector.jpg" alt="Card image" style="max-width: 100px">
            <div class="card-body">
                <h4 class="card-title">{{ name }}</h4>
                <p class="card-text">Some example text.</p>
                <button class="btn btn-primary">Follow</Button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            name: ''
        }
    },

    mounted () {
        console.log('Info component Mounted')
        axios.get('/api/account')
        .then((response) => {
            this.name = response.data.name
        })
    }
}
</script>

<style>

</style>