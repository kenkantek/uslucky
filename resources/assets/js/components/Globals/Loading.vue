<template>
	<div class="loader">Loading...</div>
</template>

<style scoped>
    .loader:before,
    .loader:after,
    .loader {
      border-radius: 50%!important;
      width: 2.5em;
      height: 2.5em;
      -webkit-animation-fill-mode: both;
              animation-fill-mode: both;
      -webkit-animation: load7 1.8s infinite ease-in-out;
              animation: load7 1.8s infinite ease-in-out;
    }
    .loader {
      font-size: 6px;
      margin: 5px auto;
      position: relative;
      text-indent: -9999em;
      -webkit-transform: translateZ(0);
              transform: translateZ(0);
      -webkit-animation-delay: -0.16s;
              animation-delay: -0.16s;
    }
    .loader:before {
      left: -3.5em;
      -webkit-animation-delay: -0.32s;
              animation-delay: -0.32s;
    }
    .loader:after {
      left: 3.5em;
    }
    .loader:before,
    .loader:after {
      content: '';
      position: absolute;
      top: 0;
    }
    @-webkit-keyframes load7 {
      0%,
      80%,
      100% {
        box-shadow: 0 2.5em 0 -1.3em #26B9EB;
      }
      40% {
        box-shadow: 0 2.5em 0 0 #26B9EB;
      }
    }
    @keyframes load7 {
      0%,
      80%,
      100% {
        box-shadow: 0 2.5em 0 -1.3em #26B9EB;
      }
      40% {
        box-shadow: 0 2.5em 0 0 #26B9EB;
      }
    }
</style>