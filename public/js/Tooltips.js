$(document).ready(function () {
    // Set the tooltips in the homepage

    tippy('#night-mode', {
        content: "Turn ON/OFF the night mode"
    });

    tippy('#control-sidebar', {
        content: "Show/Hide the Sidebar"
    });

    tippy('.fa-download', {
        content: "Downloads a .txt file containing all the current warnings in the ontology"
    });

    tippy('#warnings', {
        content: "The number of warnings in your current ontology"
    });

    tippy('#errors', {
        content: "The number of errors in your current ontology"
    });

    tippy('.fa-question-circle', {
        content: "Click to see more information!"
    });

    tippy('#classes', {
        content: "The number of classes in your current ontology"
    });

    tippy('#relations', {
        content: "The number of relations in your current ontology"
    });

    tippy('#instances', {
        content: "The number of instances in your current ontology"
    });

    tippy('#download-ontology-report', {
        content: "Download a report with all the information of your current ontology"
    });

    tippy('#open-last-updated-ontology', {
       content: "Open the last updated ontology in your ontology manager (useful when multiple collaborators are editing the ontology at the same time)"
    });

    tippy('#methodology-icon', {
        content: "Methodology Menu"
    });

    tippy('#tips-icon', {
        content: "Tips Menu"
    });
});