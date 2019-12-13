<template>
  <weekly-cohort-chart></weekly-cohort-chart>
</template>

<script>
import weeklyCohortChart from './components/weeklyCohortChart'
export default {
  name: 'App',
  components: {
    'weekly-cohort-chart': weeklyCohortChart
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
