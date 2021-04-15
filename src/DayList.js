import React, { Component } from "react";

class DayList extends React.Component {
    render() {
        const displayDay = function(day) {
            return <tr key={day.datetime.timestamp}>
                <td className="px-6 py-4">
                    <strong>{day.datetime.formatted_day}</strong>
                    &nbsp;&nbsp;
                    {day.datetime.formatted_date}
                </td>
                <td className="px-6 py-4">
                    <img src={day.condition.icon} alt={day.condition.desc} className="inline"/> {day.condition.name}
                </td>
                <td className="px-6 py-4">
                    Min <span className="text-lg"><strong>{day.forecast.temp_min}&#730;C</strong></span>
                    &nbsp;&nbsp;
                    Max <span className="text-lg"><strong>{day.forecast.temp_max}&#730;C</strong></span>
                </td>
            </tr>
        };

        if (this.props.days.length == 0) {
            return '';
        } else {
            return (
                <div>
                    <table className='rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead className="bg-gray-50">
                            <tr className="text-gray-600 text-left">
                                <th className="font-semibold text-sm uppercase px-6 py-4">
                                    Day
                                </th>
                                <th className="font-semibold text-sm uppercase px-6 py-4">
                                    Conditions
                                </th>
                                <th className="font-semibold text-sm uppercase px-6 py-4">
                                    Temperature
                                </th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-200">
                            { this.props.days.map(displayDay) }
                        </tbody>
                    </table>

                </div>
            );
        }
    }
}

export default DayList;