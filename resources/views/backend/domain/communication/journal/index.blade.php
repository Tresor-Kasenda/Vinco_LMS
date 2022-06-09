@extends('backend.layout.communication')

@section('title', "Journal de Classe")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content"><h3 class="nk-block-title page-title">
                                Journal de Classe</h3></div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">
                            <div id="calendar"
                                 class="nk-calendar fc fc-media-screen fc-direction-ltr fc-theme-bootstrap"
                                 style="height: 800px;">
                                <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                                    <div class="fc-toolbar-chunk"><h2 class="fc-toolbar-title" id="fc-dom-1">Jun 5 – 11,
                                            2022</h2>
                                        <div class="btn-group">
                                            <button type="button" title="Previous week" aria-pressed="false"
                                                    class="fc-prev-button btn btn-primary"><span
                                                    class="fa fa-chevron-left"></span></button>
                                            <button type="button" title="Next week" aria-pressed="false"
                                                    class="fc-next-button btn btn-primary"><span
                                                    class="fa fa-chevron-right"></span></button>
                                        </div>
                                    </div>
                                    <div class="fc-toolbar-chunk"></div>
                                    <div class="fc-toolbar-chunk">
                                    </div>
                                </div>
                                <div aria-labelledby="fc-dom-1" class="fc-view-harness fc-view-harness-active">
                                    <div class="fc-timegrid fc-timeGridWeek-view fc-view">
                                        <table role="grid" class="fc-scrollgrid table-bordered fc-scrollgrid-liquid">
                                            <thead role="rowgroup">
                                            <tr role="presentation"
                                                class="fc-scrollgrid-section fc-scrollgrid-section-header ">
                                                <th role="presentation">
                                                    <div class="fc-scroller-harness">
                                                        <div class="fc-scroller" style="overflow: hidden scroll;">
                                                            <table role="presentation" class="fc-col-header "
                                                                   style="width: 1090px;">
                                                                <colgroup>
                                                                    <col style="width: 54px;">
                                                                </colgroup>
                                                                <thead role="presentation">
                                                                <tr role="row">
                                                                    <th aria-hidden="true" class="fc-timegrid-axis">
                                                                        <div class="fc-timegrid-axis-frame"></div>
                                                                    </th>
                                                                    <th role="columnheader"
                                                                        class="fc-col-header-cell fc-day fc-day-sun fc-day-past"
                                                                        data-date="2022-06-05">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion "
                                                                                aria-label="June 5, 2022">Sun 6/5</a>
                                                                        </div>
                                                                    </th>
                                                                    <th role="columnheader"
                                                                        class="fc-col-header-cell fc-day fc-day-mon fc-day-today "
                                                                        data-date="2022-06-06">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion "
                                                                                aria-label="June 6, 2022">Mon 6/6</a>
                                                                        </div>
                                                                    </th>
                                                                    <th role="columnheader"
                                                                        class="fc-col-header-cell fc-day fc-day-tue fc-day-future"
                                                                        data-date="2022-06-07">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion "
                                                                                aria-label="June 7, 2022">Tue 6/7</a>
                                                                        </div>
                                                                    </th>
                                                                    <th role="columnheader"
                                                                        class="fc-col-header-cell fc-day fc-day-wed fc-day-future"
                                                                        data-date="2022-06-08">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion "
                                                                                aria-label="June 8, 2022">Wed 6/8</a>
                                                                        </div>
                                                                    </th>
                                                                    <th role="columnheader"
                                                                        class="fc-col-header-cell fc-day fc-day-thu fc-day-future"
                                                                        data-date="2022-06-09">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion "
                                                                                aria-label="June 9, 2022">Thu 6/9</a>
                                                                        </div>
                                                                    </th>
                                                                    <th role="columnheader"
                                                                        class="fc-col-header-cell fc-day fc-day-fri fc-day-future"
                                                                        data-date="2022-06-10">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion "
                                                                                aria-label="June 10, 2022">Fri 6/10</a>
                                                                        </div>
                                                                    </th>
                                                                    <th role="columnheader"
                                                                        class="fc-col-header-cell fc-day fc-day-sat fc-day-future"
                                                                        data-date="2022-06-11">
                                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                                                class="fc-col-header-cell-cushion "
                                                                                aria-label="June 11, 2022">Sat 6/11</a>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody role="rowgroup">
                                            <tr role="presentation"
                                                class="fc-scrollgrid-section fc-scrollgrid-section-body ">
                                                <td role="presentation">
                                                    <div class="fc-scroller-harness">
                                                        <div class="fc-scroller" style="overflow: hidden scroll;">
                                                            <div
                                                                class="fc-daygrid-body fc-daygrid-body-unbalanced fc-daygrid-body-natural"
                                                                style="width: 1090px;">
                                                                <table role="presentation"
                                                                       class="fc-scrollgrid-sync-table"
                                                                       style="width: 1090px;">
                                                                    <colgroup>
                                                                        <col style="width: 54px;">
                                                                    </colgroup>
                                                                    <tbody role="presentation">
                                                                    <tr role="row">
                                                                        <td aria-hidden="true"
                                                                            class="fc-timegrid-axis fc-scrollgrid-shrink">
                                                                            <div
                                                                                class="fc-timegrid-axis-frame fc-scrollgrid-shrink-frame fc-timegrid-axis-frame-liquid">
                                                                                <span
                                                                                    class="fc-timegrid-axis-cushion fc-scrollgrid-shrink-cushion fc-scrollgrid-sync-inner">all-day</span>
                                                                            </div>
                                                                        </td>
                                                                        <td role="gridcell"
                                                                            class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                            data-date="2022-06-05">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-events">
                                                                                    <div
                                                                                        class="fc-daygrid-event-harness"
                                                                                        style="margin-top: 0px;"><a
                                                                                            class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-primary"
                                                                                            tabindex="0">
                                                                                            <div class="fc-event-main">
                                                                                                <div
                                                                                                    class="fc-event-main-frame">
                                                                                                    <div
                                                                                                        class="fc-event-title-container">
                                                                                                        <div
                                                                                                            class="fc-event-title fc-sticky">
                                                                                                            The leap
                                                                                                            into
                                                                                                            electronic
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="fc-event-resizer fc-event-resizer-end"></div>
                                                                                        </a></div>
                                                                                    <div class="fc-daygrid-day-bottom"
                                                                                         style="margin-top: 0px;"></div>
                                                                                </div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td role="gridcell"
                                                                            class="fc-daygrid-day fc-day fc-day-mon fc-day-today "
                                                                            data-date="2022-06-06">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-events">
                                                                                    <div
                                                                                        class="fc-daygrid-event-harness"
                                                                                        style="margin-top: 0px;"><a
                                                                                            class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today fc-event-primary"
                                                                                            tabindex="0"
                                                                                            data-bs-original-title=""
                                                                                            title="">
                                                                                            <div class="fc-event-main">
                                                                                                <div
                                                                                                    class="fc-event-main-frame">
                                                                                                    <div
                                                                                                        class="fc-event-title-container">
                                                                                                        <div
                                                                                                            class="fc-event-title fc-sticky">
                                                                                                            Piece of
                                                                                                            classical
                                                                                                            Latin
                                                                                                            literature
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="fc-event-resizer fc-event-resizer-end"></div>
                                                                                        </a></div>
                                                                                    <div class="fc-daygrid-day-bottom"
                                                                                         style="margin-top: 0px;"></div>
                                                                                </div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td role="gridcell"
                                                                            class="fc-daygrid-day fc-day fc-day-tue fc-day-future"
                                                                            data-date="2022-06-07">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-events">
                                                                                    <div class="fc-daygrid-day-bottom"
                                                                                         style="margin-top: 0px;"></div>
                                                                                </div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td role="gridcell"
                                                                            class="fc-daygrid-day fc-day fc-day-wed fc-day-future"
                                                                            data-date="2022-06-08">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-events">
                                                                                    <div class="fc-daygrid-day-bottom"
                                                                                         style="margin-top: 0px;"></div>
                                                                                </div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td role="gridcell"
                                                                            class="fc-daygrid-day fc-day fc-day-thu fc-day-future"
                                                                            data-date="2022-06-09">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-events">
                                                                                    <div class="fc-daygrid-day-bottom"
                                                                                         style="margin-top: 0px;"></div>
                                                                                </div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td role="gridcell"
                                                                            class="fc-daygrid-day fc-day fc-day-fri fc-day-future"
                                                                            data-date="2022-06-10">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-events">
                                                                                    <div class="fc-daygrid-day-bottom"
                                                                                         style="margin-top: 0px;"></div>
                                                                                </div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td role="gridcell"
                                                                            class="fc-daygrid-day fc-day fc-day-sat fc-day-future"
                                                                            data-date="2022-06-11">
                                                                            <div
                                                                                class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                <div class="fc-daygrid-day-events">
                                                                                    <div class="fc-daygrid-day-bottom"
                                                                                         style="margin-top: 0px;"></div>
                                                                                </div>
                                                                                <div class="fc-daygrid-day-bg"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr role="presentation" class="fc-scrollgrid-section">
                                                <td class="fc-timegrid-divider table-active"></td>
                                            </tr>
                                            <tr role="presentation"
                                                class="fc-scrollgrid-section fc-scrollgrid-section-body  fc-scrollgrid-section-liquid">
                                                <td role="presentation">
                                                    <div class="fc-scroller-harness fc-scroller-harness-liquid">
                                                        <div class="fc-scroller fc-scroller-liquid-absolute"
                                                             style="overflow: hidden scroll;">
                                                            <div class="fc-timegrid-body" style="width: 1090px;">
                                                                <div class="fc-timegrid-slots">
                                                                    <table aria-hidden="true" class="table-bordered"
                                                                           style="width: 1090px;">
                                                                        <colgroup>
                                                                            <col style="width: 54px;">
                                                                        </colgroup>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="00:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        12am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="00:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="00:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="00:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="01:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        1am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="01:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="01:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="01:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="02:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        2am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="02:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="02:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="02:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="03:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        3am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="03:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="03:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="03:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="04:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        4am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="04:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="04:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="04:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="05:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        5am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="05:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="05:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="05:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="06:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        6am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="06:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="06:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="06:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="07:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        7am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="07:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="07:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="07:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="08:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        8am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="08:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="08:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="08:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="09:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        9am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="09:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="09:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="09:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="10:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        10am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="10:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="10:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="10:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="11:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        11am
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="11:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="11:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="11:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="12:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        12pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="12:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="12:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="12:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="13:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        1pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="13:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="13:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="13:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="14:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        2pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="14:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="14:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="14:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="15:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        3pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="15:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="15:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="15:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="16:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        4pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="16:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="16:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="16:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="17:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        5pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="17:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="17:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="17:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="18:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        6pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="18:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="18:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="18:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="19:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        7pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="19:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="19:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="19:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="20:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        8pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="20:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="20:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="20:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="21:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        9pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="21:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="21:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="21:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="22:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        10pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="22:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="22:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="22:30:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-scrollgrid-shrink"
                                                                                data-time="23:00:00">
                                                                                <div
                                                                                    class="fc-timegrid-slot-label-frame fc-scrollgrid-shrink-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-slot-label-cushion fc-scrollgrid-shrink-cushion">
                                                                                        11pm
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane "
                                                                                data-time="23:00:00"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-label fc-timegrid-slot-minor"
                                                                                data-time="23:30:00"></td>
                                                                            <td class="fc-timegrid-slot fc-timegrid-slot-lane fc-timegrid-slot-minor"
                                                                                data-time="23:30:00"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="fc-timegrid-cols">
                                                                    <table role="presentation" style="width: 1090px;">
                                                                        <colgroup>
                                                                            <col style="width: 54px;">
                                                                        </colgroup>
                                                                        <tbody role="presentation">
                                                                        <tr role="row">
                                                                            <td aria-hidden="true"
                                                                                class="fc-timegrid-col fc-timegrid-axis">
                                                                                <div class="fc-timegrid-col-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-now-indicator-container">
                                                                                        <div
                                                                                            class="fc-timegrid-now-indicator-arrow"
                                                                                            style="top: 606.19px;"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-timegrid-col fc-day fc-day-sun fc-day-past"
                                                                                data-date="2022-06-05">
                                                                                <div class="fc-timegrid-col-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-col-bg"></div>
                                                                                    <div class="fc-timegrid-col-events">
                                                                                        <div
                                                                                            class="fc-timegrid-event-harness fc-timegrid-event-harness-inset"
                                                                                            style="inset: 321px 0% -385px; z-index: 1;">
                                                                                            <a class="fc-timegrid-event fc-v-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past fc-event-danger"
                                                                                               tabindex="0">
                                                                                                <div
                                                                                                    class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-time">
                                                                                                            5:00
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Rujfogve
                                                                                                                kabwih
                                                                                                                haznojuf.
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end"></div>
                                                                                            </a></div>
                                                                                        <div
                                                                                            class="fc-timegrid-event-harness fc-timegrid-event-harness-inset"
                                                                                            style="inset: 449px 0% -513px; z-index: 1;">
                                                                                            <a class="fc-timegrid-event fc-v-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past fc-event-primary-dim"
                                                                                               tabindex="0">
                                                                                                <div
                                                                                                    class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-time">
                                                                                                            7:00
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                simply
                                                                                                                dummy
                                                                                                                text of
                                                                                                                the
                                                                                                                printing
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end"></div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-now-indicator-container"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-timegrid-col fc-day fc-day-mon fc-day-today "
                                                                                data-date="2022-06-06">
                                                                                <div class="fc-timegrid-col-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-col-bg"></div>
                                                                                    <div class="fc-timegrid-col-events">
                                                                                        <div
                                                                                            class="fc-timegrid-event-harness fc-timegrid-event-harness-inset"
                                                                                            style="inset: 642px 0% -706px; z-index: 1;">
                                                                                            <a class="fc-timegrid-event fc-v-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today fc-event-future fc-event-info"
                                                                                               tabindex="0">
                                                                                                <div
                                                                                                    class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-time">
                                                                                                            10:00
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Nogok
                                                                                                                kewwib
                                                                                                                ezidbi.
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end"></div>
                                                                                            </a></div>
                                                                                        <div
                                                                                            class="fc-timegrid-event-harness fc-timegrid-event-harness-inset"
                                                                                            style="inset: 930px 0% -995px; z-index: 1;">
                                                                                            <a class="fc-timegrid-event fc-v-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today fc-event-future fc-event-warning-dim"
                                                                                               tabindex="0">
                                                                                                <div
                                                                                                    class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-time">
                                                                                                            2:30
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Mifebi
                                                                                                                ik
                                                                                                                cumean.
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end"></div>
                                                                                            </a></div>
                                                                                        <div
                                                                                            class="fc-timegrid-event-harness fc-timegrid-event-harness-inset"
                                                                                            style="inset: 1123px 0% -1187px; z-index: 1;">
                                                                                            <a class="fc-timegrid-event fc-v-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today fc-event-future fc-event-info"
                                                                                               tabindex="0">
                                                                                                <div
                                                                                                    class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-time">
                                                                                                            5:30
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Play
                                                                                                                Time
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end"></div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-now-indicator-container">
                                                                                        <div
                                                                                            class="fc-timegrid-now-indicator-line"
                                                                                            style="top: 606.19px;"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-timegrid-col fc-day fc-day-tue fc-day-future"
                                                                                data-date="2022-06-07">
                                                                                <div class="fc-timegrid-col-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-col-bg"></div>
                                                                                    <div class="fc-timegrid-col-events">
                                                                                        <div
                                                                                            class="fc-timegrid-event-harness fc-timegrid-event-harness-inset"
                                                                                            style="inset: 1027px 0% -1091px; z-index: 1;">
                                                                                            <a class="fc-timegrid-event fc-v-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-future fc-event-danger-dim"
                                                                                               tabindex="0">
                                                                                                <div
                                                                                                    class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-time">
                                                                                                            4:00
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Jidehse
                                                                                                                gegoj
                                                                                                                fupelone.
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end"></div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-now-indicator-container"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-timegrid-col fc-day fc-day-wed fc-day-future"
                                                                                data-date="2022-06-08">
                                                                                <div class="fc-timegrid-col-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-col-bg"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-now-indicator-container"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-timegrid-col fc-day fc-day-thu fc-day-future"
                                                                                data-date="2022-06-09">
                                                                                <div class="fc-timegrid-col-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-col-bg"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-now-indicator-container"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-timegrid-col fc-day fc-day-fri fc-day-future"
                                                                                data-date="2022-06-10">
                                                                                <div class="fc-timegrid-col-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-col-bg"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-now-indicator-container"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-timegrid-col fc-day fc-day-sat fc-day-future"
                                                                                data-date="2022-06-11">
                                                                                <div class="fc-timegrid-col-frame">
                                                                                    <div
                                                                                        class="fc-timegrid-col-bg"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-col-events"></div>
                                                                                    <div
                                                                                        class="fc-timegrid-now-indicator-container"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
