<template>
    <div
        class="flex flex-1 flex-col gap-5 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between">
            <span class="flex gap-2 items-center">
                <img class="w-14 h-14 rounded-full"
                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs="
                    alt="Rounded avatar">
                <span class="flex flex-col">
                    <span>{{ $page.props.auth.user.current_team.name }}</span>
                    <span>{{ this.formData.postDate.toString() }}</span>
                </span>
            </span>
        </div>
        <p class="py-4 ">
           {{ formData.content }}
        </p>

        <Splide class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <SplideSlide v-if="this.formData.files.length > 0"
                v-for="( item, index ) in  this.formData.orderedFiles " :key="index" class="w-full h-72 ">
                <img :src="item.url" alt="" class="object-contain h-full w-auto text-center mx-auto">
            </SplideSlide>
            <SplideSlide v-else>
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=" alt="" class="object-contain h-80 w-auto text-center mx-auto">
            </SplideSlide>
        </Splide>
        <div>
            <div class=" h-auto py-4 text-gray-500" v-if="tagState">
                {{  formData.tags.length > 1 ? formData.tags.map(x => "#" + x).join(" ") : "how to win friends and influence people review,how to win friends and influence people summary,how to win friends and influence people,how to win friends,how to make friends,dale carnegie,leadership,book summary" }}
            </div>
            <button @click="tagState = !tagState">Show Tags</button>
        </div>
    </div>
</template>

<script>

export default {
    props: ["formData"],
    data() {
        return {
            tagState: false,
        };
    },
}
</script>

<style lang="scss" scoped></style>