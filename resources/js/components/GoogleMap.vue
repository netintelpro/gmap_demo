<template>
    <div>
        <form-component></form-component>
        <gmap-map
            :center="center"
            :zoom="7"
            style="width:50%; height: 320px;"
        ></gmap-map>
        <gmap-cluster>
            <gmap-marker
                v-for="(impact, index) in impacts"
                :key="impact.id"
                :position="{lat:impact.event.latitude, lng:impact.event.longitude}"
                :clickable="true"
                :draggable="false"
                @click="handleMarkerClicked(i)"
            ></gmap-marker>
        </gmap-cluster>

    </div>
</template>

<script>
    import FormComponent from "./FormComponent.vue";

    export default {

        name: "GoogleMap",
        props: {
            center: String,
            impacts: Object,
        },
    }
</script>
<style scoped>

</style>
