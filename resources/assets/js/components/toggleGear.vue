<template lang="jade">
    .export
        label(for="toggle-drop-down")
            i.fa.fa-gear

        input#toggle-drop-down(type="checkbox" v-model="toggleDropDown")
        slot
</template>

<style lang="stylus">

$black = #333

.export
    position: absolute
    right: 0
    top: 0
    z-index: 2
    padding: 10px


    label[for="toggle-drop-down"]
        cursor: pointer
        float: right
        font-weight: bold
        color: lighten($black, 50%)
        transition: all .3s ease-in-out

        &:hover
            color: $black

#toggle-drop-down
    opacity: 0

    &:checked + .dropdown-box>.dropdown
        opacity: 1
        top: 0
</style>

<script>
    export default{
        data(){
            return{
                toggleDropDown: false
            }
        },

        watch: {
            toggleDropDown(value) {
                var self = this;

                if ( value == true )
                    setTimeout(() => self.toggleDropDown = false, 10000);
            }
        }
    }
</script>