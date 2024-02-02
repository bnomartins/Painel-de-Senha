<template>
<!-- Aviso -->

    <div :class="{'loader-background' : on}">
        <div :class="{'loader' : on}"></div>

    </div>

</template>

<script setup>

defineProps(
    {
        on: {
            type: Object
        }
    }
)
</script>

<style scoped>

.loader {
    border: 16px solid white;
    border-radius: 50%;
    border-top: 16px solid #084cdf;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;

    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 100px;
    height: 100px;
    z-index: 999;
  }

  .loader-background {
    position:absolute;
    z-index:998;
    cursor:forbidden;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;    
    width:100%;
    height:100vh;
    background-color:rgba(0,0,0,0.2);
    color:white;
    display:block;
      }
  
  /* Safari */
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>

