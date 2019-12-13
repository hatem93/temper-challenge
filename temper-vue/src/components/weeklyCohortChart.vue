<template>
<div>
  <highcharts :options="chartOptions"></highcharts>
</div>

</template>
<script>
export default {
  name: 'weeklyCohortChart',
  data () {
    return {
      chartOptions: {
      }
    }
  },
  created () {
    this.$http.get('http://localhost:8081/charts').then(function (response) {
      console.log(response.data.message)
      this.chartOptions = {
        title: {text: 'Temper Weekly Retention Cohort Chart'},
        series: response.data.message,
        yAxis: {title: {text: 'Total Onboarded'}, labels: {format: '{value}%'}, min: '0', max: 100},
        margin: 0
      }
    })
  }
}
</script>

<style scoped>

</style>
