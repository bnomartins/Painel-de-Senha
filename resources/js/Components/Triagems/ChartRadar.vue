<template>
  <RadarChart :chartData="testData" width="210" height="210"/>
</template>

<script setup>
  import { Link, useForm } from "@inertiajs/vue3";
  import { RadarChart } from 'vue-chart-3';
  import {Chart, registerables } from 'chart.js';

  Chart.register(...registerables);

  const props = defineProps({
    data: {
      Type: Array
    },
    data2: {
      Type: Array
    },
    labels: {
      Type: Array
    },
    name: {
      Type: String
    }
  })

  const testData = {
      labels: props.labels,
      datasets: [
        {
          label: props.name,
          data: props.data,
          backgroundColor: ['#9BD0F5'],
          borderColor: ['#36A2EB'],
        },
        {
          label: 'Ref.',
          data: props.data2,
        },
      ],

    }

  </script>
