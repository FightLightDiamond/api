<template>
    <div>
        <h2>Random quân trong game AOE</h2>
        <div class="form-group">
            <div class="input-group">
                <input type="text" v-model="teamSize" class="form-control" placeholder="Enter team Size">
                <span class="input-group-btn">
                    <button class="btn btn-primary" @click="onRandomTeam()" type="button">Random</button>
                </span>
            </div><!-- /input-group -->
        </div>
        <table class="table table-striped table-hover table-bordered" style="color: lightslategrey; font-weight: bold">
            <thead>
            <tr class="active" >
                <th style="width: 40% !important;">Vị trí</th>
                <th>Quân</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(item, index) in countries" :key="`rd_${index}`">
                <td>
                    {{index + 1}}
                </td>
                <td>
                    {{item}}
                </td>
            </tr>
            </tbody>

        </table>
        <p>Nếu thấy hay, hãy chia sẻ ngay tới công đồng game thủ</p>
        <p>Phát triển bởi package <a href="https://www.npmjs.com/package/aoerandom">aoerandom</a></p>
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

