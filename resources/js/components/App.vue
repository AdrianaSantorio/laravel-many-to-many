<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <Header :title="title" />
                    <div class="card-body">
                        <h1>Boolpress is coming soon</h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Header from './Header.vue';
    export default{
        name:"App",
        components: {
            Header,
        },
        data() {
            return {
                title: "Welcome",
            }
        }
    }

   
</script>
