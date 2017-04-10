<template>
    <input type="text" v-model="new_task"><button v-on:click="addTask">Добавить</button>
    <div class="collection task" v-if="tasks.length">
        <div class="task collection-item" v-for="task in tasks">
            <a href="#!">{{ task.title }}</a>
            <a href="#!" class="secondary-content"><i class="material-icons">delete</i></a>
        </div>
    </div>

    <div class="collection task" v-else>
        <a href="#!" class="collection-item red-text">-- no tasks --</a>
    </div>
</template>

<script>
export default {
    data(){
        return {
            tasks: [],
            new_task: '',
            i: 0
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
            var _this = this;
            $.ajax({
                type: 'GET',
                url: '/tasks',
                dataType: 'JSON',
                success: function(data) {
                    data.forEach(function (task) {
                        _this.tasks.push({
                            title: 'Record #' + _this.i + ": " + task.name
                        });
                        _this.i++;
                    })
                }
            });
        },
        addTask() {
            var _this = this;
            $.ajax({
                type: 'POST',
                url: '/tasks',
                data: {
                    name: _this.new_task
                },
                dataType: 'JSON',
                success: function() {
                    _this.tasks.push({
                        title: 'Record #' + _this.i + ": " + _this.new_task
                    });
                    _this.i++;
                }
            });
            _this.tasks.push({
                title: 'Record #' + _this.i + ": " + _this.new_task
            });
            _this.i++;
        }
    }
}
</script>
