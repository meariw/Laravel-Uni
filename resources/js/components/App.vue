<template>
    <div
        v-if="article != null"
        style="
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: #6f4e37;
            color: #fdf6ee;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            max-width: 320px;
        "
    >
        Добавлена новая статья
        <strong
            ><a :href="`/articles/${article.id}`" style="color: #e8c39e">{{
                article.title
            }}</a></strong
        >
        <button
            @click="article = null"
            style="
                margin-left: 12px;
                background: none;
                border: none;
                color: #fdf6ee;
                cursor: pointer;
                font-size: 18px;
            "
        >
            ×
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return { article: null };
    },
    created() {
        window.Echo.channel("test").listen("NewArticleEvent", (data) => {
            this.article = data.article;
        });
    },
};
</script>
