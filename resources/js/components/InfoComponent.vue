<template>
    <v-container>
        <v-card
        class="mx-auto"
        max-width="434"
        tile
        >
            <v-img
                height="100%"
                src="https://cdn.vuetifyjs.com/images/cards/server-room.jpg"
            >
                <v-row
                align="end"
                class="fill-height"
                >
                <v-col
                    align-self="start"
                    class="pa-0"
                    cols="12"
                >
                    <v-avatar
                    class="profile"
                    color="grey"
                    size="164"
                    tile
                    >
                    <v-img src="https://365psd.com/images/istock/previews/1009/100996291-male-avatar-profile-picture-vector.jpg"></v-img>
                    </v-avatar>
                </v-col>
                <v-col class="py-0">
                    <v-list-item
                    color="rgba(0, 0, 0, .4)"
                    dark
                    >
                    <v-list-item-content>
                        <v-list-item-title class="title">{{ name }}</v-list-item-title>
                        <v-list-item-subtitle>Network Engineer</v-list-item-subtitle>
                    </v-list-item-content>
                    </v-list-item>
                </v-col>
                </v-row>
            </v-img>
        </v-card>
    </v-container>
</template>

<script>
export default {
    props: ['id'],
    data () {
        return {
            name: ''
        }
    },

    mounted () {
        console.log('Info component Mounted')
        axios.get(`/api/users/${this.id}/like`)
        .then((response) => {
            this.name = response.data.name
        })
    }
}
</script>

<style>

</style>