<template>
    <div class="container">
        <div>
            Izberi dan:
            <el-date-picker
                    format="dd.MM.yyyy"
                    :default-value="Date.now()"
                    :clearable="false"
                    v-model="selDate"
                    @change="loadData()"
                    type="date"></el-date-picker>
        </div>


        <el-table :data="weather" style="width: 100%" v-loading.body="loading" stripe border height="500">
            <el-table-column fixed prop="created_at" :formatter="dateFormat" label="Datum in čas meritve"></el-table-column>
            <el-table-column fixed prop="created_at" :formatter="timeFormat" label="čas meritve"></el-table-column>
            <el-table-column sortable prop="temp" label="Temperatura (°C)"></el-table-column>
            <el-table-column sortable prop="hum" label="Vlažnost (%)"></el-table-column>
            <el-table-column sortable prop="wind_speed" label="Hitrost vetra (km/h)"></el-table-column>
            <el-table-column sortable prop="wind_blow" label="Sunek vetra (km/h)"></el-table-column>
            <el-table-column sortable prop="wind_dir" label="smer vetra (°)"></el-table-column>
            <el-table-column sortable prop="rain_power" label="Jakost padavin (mm/h)"></el-table-column>
            <el-table-column sortable prop="rain_sum" label="Vsota padavin (mm)"></el-table-column>
            <el-table-column sortable prop="pressure" label="Zračni tlak (mb)"></el-table-column>
            <el-table-column sortable prop="uv" label="UV indeks"></el-table-column>
            <el-table-column sortable prop="sun" label="Sončno obsevanje (w/m2)"></el-table-column>
            <el-table-column sortable prop="et" label="ET izhlapevanje (mm)"></el-table-column>
            <el-table-column sortable prop="win_prev" label="Prev. smer vetra"></el-table-column>
            <el-table-column sortable prop="sun_time" label="trajanje sončnega obsevanja (h)"></el-table-column>
        </el-table>
    </div>
</template>

<script>
    import format from 'date-fns/format';

    export default {
        data() {
            return {
                weather: [],
                selDate: new Date(),
                loading: false
            }
        },

        methods: {
            loadData() {
                this.loading = true;
                axios.get('/weather.php', { params: { day: this.selDate } })
                    .then((response) => {
                        this.weather = response.data;
                        this.loading = false;
                    });
            },
            dateFormat(row, column) {
                return format(row.created_at, 'D. M. YYYY');
            },
            timeFormat(row, column) {
                return format(row.created_at, 'HH:mm');
            }
        },

        mounted() {
            this.loadData();
        }
    }
</script>
