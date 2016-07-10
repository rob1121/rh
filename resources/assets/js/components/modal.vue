<template>
    <div @click="closeModal" v-show="isModalOpen" class="Modal u-overlay"  transition="fade">
        <div @click.stop="" v-show="isModalOpen" class="Modal__container" transition="popup">
            <header class="Modal__header">
                <h1>
                    @{{ title }}
                </h1>
            </header>

            <div class="Modal__content">
                <slot></slot>
            </div>

            <footer class="Modal__footer"></footer>
        </div>
    </div>
</template>
<style>
    .Modal__container {
        max-width: 700px;
        width: 90%;
        background: white;
        border-radius: 2px;
        animation-duration: 0.3s;
        animation-delay: 0s;
    }

    .Modal__header {
        border-bottom: 1px solid white;
        padding: 15px 10px;
        background-color: silver;
        color: white;
        border-radius: 2px;
    }

    .Modal__header > h1 {
        font-size: 27px;
        font-weight: normal;
        margin: 0;
    }

    .Modal__content {
        padding: 10px;
    }

    .Modal__footer {
        padding: 5px;
    }

    .u-overlay {
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .popup-enter {
        animation: enterPopup;
        animation-duration: .3s;
    }

    .popup-leave {
        animation: leavePopup;
        animation-duration: .7s;
    }

    .fade-enter {
        animation: enterFade;
        animation-duration: .3s;
    }

    .fade-leave {
        animation: leaveFade;
        animation-duration: .7s;
    }

    @keyframes enterPopup {
        0% {
            transform: scale(0);
        }

        90% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    @keyframes leavePopup {
        0% {
            transform: scale(1);
        }

        10% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(0);
        }
    }

    @keyframes enterFade {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes leaveFade {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
</style>
<script>
    export default{
        props: ['id', 'title'],

        created() {
            this.closeModal();
        },

        computed: {
            isModalOpen() {
                return this.$root[this.id + 'IsOpen'];
            }
        },

        methods: {
            closeModal() {
                this.$root.$set(this.id + 'IsOpen', false);
            }
        }
    }
</script>