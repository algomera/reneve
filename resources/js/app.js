import './bootstrap';

//jQuery
import jQuery from 'jquery';
window.$ = jQuery;

//DataTable
import DataTable from "datatables.net-dt";
window.DataTable = DataTable;

//FullCalendar
import { Calendar } from 'fullcalendar'
window.Calendar = Calendar;
import dayGridPlugin from '@fullcalendar/daygrid';
window.dayGridPlugin = dayGridPlugin;
import timeGridPlugin from '@fullcalendar/timegrid';
window.timeGridPlugin = timeGridPlugin;
import listPlugin from '@fullcalendar/list';
window.listPlugin = listPlugin;
import interaction from '@fullcalendar/interaction';
window.interaction = interaction;

//Moment
import moment from 'moment';
window.moment = moment;
moment().format();

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
