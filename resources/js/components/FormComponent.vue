<template>
    <div>
        <form>
            <label for="start">Start date:</label>

            <input type="date" id="start" name="start">

            <label for="end">End date:</label>

            <input type="date" id="end" name="end">

            <label for="address">Address</label>
            <input type="address" id="address" name="address">
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
