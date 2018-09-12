<template>
    <div class="select-lam">
        <input id="id_bplv" name="id_eplv" type="text" class="form-control" :placeholder="placeholder_lam">
        <div class="body-select-lam" id="bplv">
            <ul>
                <!--<li @click="show_select_lam(n,'id_bplv')" v-for="n in list_bo_phan">-->
                    <!--<span>VT-001</span>-->
                    <!--<span class="pull-right">{{n.ten_bo_phan}}</span>-->
                <!--</li>-->
                <li v-for="n in data_lam">
                    <span>VT-001</span>
                    <span class="pull-right">dâdasd</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'select-lam',
        props: {
            placeholder_lam: String,
            data_lam: Array
        }
    }
</script>

<style scoped>
    .select-lam {
        position: relative !important;
    }
    .select-lam:hover .body-select-lam {
        display: block;
    }

    .body-select-lam {
        position: absolute;
        top: 40px;
        left: 0;
        width: 100%;
        z-index: 200;
        max-height: 200px;
        overflow-y: auto;
        /* display: none; */
        -webkit-transition: ease;
        transition: ease;
        background-color: #fff;
    }

    .body-select-lam ul {
        padding: 0;
        border: 1px solid #ddddff;
        background-color: #fff;
        font-size: 13px;
        color: black;
        font-weight: 500;
    }

    .body-select-lam ul li {
        list-style-type: none;
        padding: 5px;
        cursor: pointer;
    }

    .body-select-lam ul li:hover {
        background-color: #ddd;
    }
</style>