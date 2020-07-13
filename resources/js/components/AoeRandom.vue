<template>
    <div>
        <h5>Giúp đỡ game thủ random quân trong game AOE</h5>
        <div>
            <div class="input-group">
                <input type="text" v-model="teamSize" class="form-control" placeholder="Enter team Size">
                <span class="input-group-btn">
                    <button class="btn btn-primary" @click="onRandomTeam()" type="button">Random</button>
                </span>
            </div><!-- /input-group -->
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Vị trí</th>
                <th>Quân</th>
            </tr>
            <tr v-for="(item, index) in countries" :key="`rd_${index}`">
                <td>
                    {{index + 1}}
                </td>
                <td>
                    {{item}}
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    import {getTeamRandom} from 'aoerandom';

    export default {
        name: "AoeRandom",
        data() {
            return {
                teamSize: 8,
                countries: [],
            };
        },
        mounted() {
            this.onRandomTeam()
        },
        methods: {
            onRandomTeam() {
                this.countries = getTeamRandom(this.teamSize);
            }
        }
    }
</script>

<style scoped>

</style>
