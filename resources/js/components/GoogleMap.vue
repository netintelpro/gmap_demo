<template>
    <div>
        <form-component></form-component>
        <gmap-map
            :center="center"
            :zoom="7"
            style="width:50%; height: 320px;"
        ></gmap-map>
        <gmap-marker
            v-for="(impact, index) in impacts"
            :key="impact.id"
            :position="{lat:impact.event.latitude, lng:impact.event.longitude}"
            :clickable="true"
            :draggable="false"
            @click="handleMarkerClicked(i)"
        ></gmap-marker>
    </div>
</template>

<script>
    export default {
        name: "GoogleMap",
        props: {
            center: Object,
            impacts: Object,
        }
    }
</script>

<style scoped>

</style>
