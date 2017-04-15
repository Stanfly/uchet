<template>
    <input type="text" v-model="new_task"><button v-on:click="addTask">Добавить</button>
    <div class="collection task" v-if="tasks.length">
        <div class="task collection-item" v-for="task in tasks">
            <a href="#!">{{ task.title }}</a>
            <a href="#!" class="secondary-content" v-on:click="removeTask"><i class="material-icons" data-task_id="{{ task.id }}">delete</i></a>
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
                new_task: ''
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
                var _this = this;
                _this.tasks = [];
                $.ajax({
                    type: 'GET',
                    url: '/tasks',
                    dataType: 'JSON',
                    success: function(data) {
                        data.forEach(function (task) {
                            _this.tasks.push({
                                title: 'Record #' + task.id + ": " + task.name,
                                id: task.id
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
                        name: _this.new_task
                    },
                    dataType: 'JSON',
                    success: function() {
                        _this.showTasks();
                    }
                });
            },
            removeTask(event) {
                var _this = this;
                $.ajax({
                    type: 'DELETE',
                    url: '/tasks/'+ event.target.dataset.task_id,
                    dataType: 'JSON',
                    success: function() {
                        _this.showTasks();
                    }
                });
            }
        }
    }
</script>
