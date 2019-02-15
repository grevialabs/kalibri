http://nitrogen.grevialabs.com/v1/users/get?key=keyfordevelopment&id=1

<!-- DEV -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<!-- PROD -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->

<div id="content"></div>

<script>
var content = new Vue({
  el: '#content',
  data: {
    message: 'You loaded this page on ' + new Date().toLocaleString()
  }
})
</script>