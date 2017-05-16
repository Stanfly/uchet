<template>

</template>

<script>
export default {
    data(){
        return {
            items: []
        };
    },
    ready() {
        console.log('Component ready.')
    },
    asyncData(){
        this.addItems();
    },
    methods: {
        addItems() {
            $.ajax({
                type: 'GET',
                url: '/'
            });
            for(var i = 0; i < 5; i++) {
                this.items.push({
                    title: 'Record #' + i
                });
            }
        }
    }
}
</script>
