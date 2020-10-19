<template>
  <span id="totalActiveUsers" class="badge badge-danger">0</span>
</template>

<script>
export default {
  mounted() {
    Echo.join(`active-user`)
      .here((users) => {
        $("#totalActiveUsers").text(
          parseInt($("#totalActiveUsers").text()) + users.length
        );
      })
      .joining((user) => {
        $("#totalActiveUsers").text(
          parseInt($("#totalActiveUsers").text()) + 1
        );
      })
      .leaving((user) => {
        $("#totalActiveUsers").text(
          parseInt($("#totalActiveUsers").text()) - 1
        );
      });
  },
};
</script>
