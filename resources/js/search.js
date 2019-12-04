/**
 * 全局搜索
 */

var app = new Vue({
    el: '#header-search-app',
    // 重新定义分解符
    delimiters: ['<{', '}>'],
    data: {
        timmer: null,
        loading: false,
        // 提交数据
        form: {
            search_type: 'is_topic',
            q: ''
        },
        // 全局搜索
        search_all_url: Config.routes.search,
        // 搜索结果
        search_blog_results: [],
        search_user_results: [],
        // 无搜索结果
        search_blog_has_results: false,
        search_user_has_results: false,
    },
    mounted() {
        let self = this;
        // 初始化搜索值
        this.form.q = $("#header-search-app input[name='q']").attr('data-value');

        $(document).click(function () {
            self.search_blog_has_results = false;
            self.search_user_has_results = false;
            self.loading = false;
        });
    },
    methods: {
        search($event) {
            this.timmer && clearTimeout(this.timmer);
            this.timmer = setTimeout(() => {
                clearTimeout(this.timmer);
                // todo
                let form = $($event.target).closest('form');
                let action = form.attr('data-api');
                this.search_all_url = Config.routes.search + '?' + form.serialize();

                this.loading = true;
                if ($.trim(this.form.q) != '') {
                    axios({
                        method: 'get',
                        url: action,
                        params: this.form
                    }).then(res => {

                        if (!res.data.data.length) {
                            this.search_blog_has_results = false;
                            this.search_user_has_results = false;
                        } else {
                            if (res.data.type === 'is_topic') {
                                this.search_blog_results = res.data.data
                                this.search_blog_has_results = true;
                                this.search_user_has_results = false;
                            } else if (res.data.type === 'is_user') {
                                this.search_user_results = res.data.data
                                this.search_blog_has_results = false;
                                this.search_user_has_results = true;
                            }
                        }
                        this.loading = false;
                    });
                } else {
                    this.search_user_has_results = false;
                    this.search_blog_has_results = false;
                    this.loading = false;
                }
            }, 200)
        }
    }
});
