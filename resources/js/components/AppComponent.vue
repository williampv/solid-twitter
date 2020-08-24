<template>
    <v-app>
        <!--<v-app-bar app dense>
            <v-container fluid>
                <v-row justify="space-around">
                    <router-link to="/">
                        <img src="https://icon-library.com/images/home-icon-images/home-icon-images-12.jpg" alt="" style="width: 40px">
                    </router-link>
                    <div>
                        <img class="card-img-top" src="https://365psd.com/images/istock/previews/1009/100996291-male-avatar-profile-picture-vector.jpg" alt="Card image" style="max-width: 40px; display: inline-block">
                        <p style="display: inline-block">{{ name }}</p>
                    </div>
                </v-row>
            </v-container>
        </v-app-bar>-->
        <v-main>
            <v-row justify="space-around">
                <router-view></router-view>
            </v-row>
        </v-main>
        <v-footer>
            
        </v-footer>
    </v-app>
</template>

<script>
export default {
    data () {
        return {
            name: ''
        }
    },

    mounted () {
        axios.get(`/api/account`)
        .then((response) => {
            this.name = response.data.name 
        })
    }
}
</script>
