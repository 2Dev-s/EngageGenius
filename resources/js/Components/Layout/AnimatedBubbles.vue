<template>
    <section class="relative mx-auto flex flex-col justify-center px-4">
        <div class="fixed left-0 right-0 top-0">
            <div class="left-16 top-0 overflow-visible opacity-50">
                <div class="circle-obj absolute h-[900px] w-[700px] rounded-[40rem] mix-blend-multiply"
                    :style="getRandomTranslate()" style="pointer-events: none;"></div>
            </div>
            <div class="absolute left-52 top-28 overflow-visible opacity-50">
                <div class="circle-obj2 absolute h-[900px] w-[700px] rounded-[40rem] mix-blend-multiply"
                    :style="getRandomTranslate()" style="pointer-events: none;"></div>
            </div>
            <div class="absolute left-20 top-32 overflow-visible opacity-0">
                <div class="circle-obj3 absolute h-[900px] w-[700px] rounded-[40rem] mix-blend-multiply"
                    :style="getRandomTranslate()" style="pointer-events: none;"></div>
            </div>
        </div>
    </section>
</template>

<script setup>
const getRandomTranslate = () => {
    const randomTranslateX = `${Math.random() * window.innerWidth}px`;
    const randomTranslateY = `${Math.random() * window.innerHeight}px`;

    return {
        transform: `translate(${randomTranslateX}, ${randomTranslateY})`,
    };
}
</script>

<style scoped>
.circle-obj {
    background: radial-gradient(closest-side, #2dd4bf, rgba(233, 168, 2, 0));
    animation: traverse-up-left 10s ease-in-out infinite alternate;
}

.circle-obj2 {
    background: radial-gradient(closest-side, #5154ee, rgba(233, 168, 2, 0));
    animation: traverse-up-right 12s ease-in-out infinite alternate;
}

.circle-obj3 {
    background: radial-gradient(closest-side, #e8ee43d9, rgba(233, 168, 2, 0));
    animation: traverse-down-right 8s ease-in-out infinite alternate;
}

@keyframes traverse-up-left {
    100% {
        transform: translateY(-200px) translateX(-350px) rotate(180deg);
    }
}

@keyframes traverse-up-right {
    100% {
        transform: translateY(-300px) translateX(300px) rotate(1turn);
    }
}

@keyframes traverse-down-right {
    100% {
        transform: translateY(250px) translateX(300px) rotate(1turn);
    }
}
</style>