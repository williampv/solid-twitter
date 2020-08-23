<template>
    <div class="container">
        <div class="container">
            <router-link :to="'/profile/'+this.id">My account</router-link>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    data () {
        return {
            id: ''
        }
    },

    mounted () {
        axios.get(`/api/account`)
        .then((response) => {
            this.id = response.data.id
        })
    }
 }
</script>
