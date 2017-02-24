<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- form search -->
                <form @submit.prevent="search" class="form-search-list">
                    <div class="row">
                        <div class="col-sm-10 col-xs-12 ">
                            <div class="form-group">
                                <label class="color-white">Cari Kata</label>
                                <input v-model="keyword" class="form-control" :placeholder="placeholder" >
                            </div>
                        </div>
                        <div class="col-sm-2 col-xs-12 ">
                            <div class="form-group">
                                <label class="hidden-xs">&nbsp;</label>
                                <button class="btn btn-block btn-theme  btn-success">Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- form search -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['placeholder'],

        data() {
            return {
                keyword: null
            }
        },

        methods: {
            search() {
                this.$emit('search', this.keyword)
            }
        }
    }
</script>