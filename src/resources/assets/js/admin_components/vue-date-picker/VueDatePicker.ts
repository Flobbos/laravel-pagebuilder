import Vue from "vue";


import {Component, Prop} from "vue-property-decorator";

//@ts-ignore
import DatePicker from 'vue-bootstrap-datetimepicker';

// Import date picker css
import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';

@Component({
    components:{
        'datePicker': DatePicker
    }
})
export default class VueDatePicker extends Vue {

    @Prop()
    oldDate: string;

    @Prop()
    name: string;


    date: Date = new Date();
    config: object = {
        locale: 'de',
        format: 'YYYY-MM-DD HH:mm:ss',
        sideBySide: true
    };

    mounted() {
        if (this.oldDate) {
            this.date = new Date(this.oldDate);
        } else {
            this.date = new Date();
        }
    }

};
