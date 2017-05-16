<template>
    <input type="text" v-model="task_input_value"><button v-on:click="addTask">Добавить</button>
    <div class="collection task" v-if="tasks.length">
        <div class="task collection-item" v-for="task in tasks">
            <a href="#!">{{ task.title }}</a>
            <a href="#!" class="secondary-content" v-on:click="removeTask""><i class="material-icons" data-task_id="{{ task.id }}" data-task_index="{{ task.index }}">delete</i></a>
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
                task_input_value: ''
            };
        },
        ready() {
            console.log('Component ready.')
        },
        asyncData(){
            this.showTasks();
        },
        methods: {
            showTasks() {
                let _this = this;
                _this.tasks = [];
                console.log("show tasks");
                $.ajax({
                    type: 'GET',
                    url: '/tasks/get',
                    dataType: 'JSON',
                    success: function(data) {
                        data.forEach(function (task, index) {
                            _this.tasks.push({
                                title: 'Record #' + task.id + ": " + task.name,
                                id: task.id,
                                index: index
                            });
                        })
                    }
                });
            },
            addTask() {
                var _this = this;
                $.ajax({
                    type: 'PUT',
                    url: '/tasks',
                    data: {
                        name: _this.task_input_value
                    },
                    dataType: 'JSON',
                    success: function(task) {
                        _this.task_input_value = '';
                        _this.tasks.push({
                            title: 'Record #' + task.id + ": " + task.name,
                            id: task.id
                        });
                    }
                });
            },
            removeTask(event) {
                var _this = this;
                _this.tasks.splice(event.target.dataset.task_index, 1)
                $.ajax({
                    type: 'DELETE',
                    url: '/tasks/'+ event.target.dataset.task_id,
                    dataType: 'JSON',
                    success: function() {
                    }
                });
            }
        }
    }
</script>
