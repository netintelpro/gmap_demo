<template>
    <div>
        <form>

            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date">
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date">
            </div>
            <div class="form-group">
                <label for="address">Street</label>
                <input type="text" id="address" name="address">
            </div>

            <div class="form-group">
                <input type="checkbox" name="type[]" value="event"> Event<br>
                <input type="checkbox" name="type[]" value="impact"> Impact<br>
            </div>

            <input class="btn btn-primary" type="submit" value="Submit" v-on:click="submitForm($event)">
            <input class="btn btn-primary" type="reset" value="Reset">

        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                impacts: [],
                events: [],
            }
        },

        methods : {
            submitForm(e) {
                e.preventDefault()
                axios.get('/api/impacts')
                    .then((response) => this.impacts = response.data)
                    .catch((error) => console.error(error));
            }
        }
    }
</script>
