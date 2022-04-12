<template>
    <header>
        <div class="card-header" v-text="title">
        </div>
    </header>
</template>

<script>
export default {
  name: "Header",
  props: ["title"],
};
</script>
