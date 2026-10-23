import './bootstrap';
import { createApp } from 'vue';
import CvApp from './components/CvApp.vue';
import CoverLetterApp from './components/CoverLetterApp.vue';

const cvEl = document.getElementById('cv-app');
if (cvEl && window.__CV_DATA__) {
    createApp(CvApp, { cv: window.__CV_DATA__ }).mount(cvEl);
}

const letterEl = document.getElementById('cover-letter-app');
if (letterEl && window.__COVER_LETTER__) {
    createApp(CoverLetterApp, { letter: window.__COVER_LETTER__ }).mount(letterEl);
}
