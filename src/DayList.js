import React, { Component } from "react";

class DayList extends React.Component {
    render() {
        const displayDay = function(day) {
            return <tr key={day.datetime.timestamp}>
                <td className="px-6 py-4">
                    {day.datetime.formatted_day}
                    <small>{day.datetime.formatted_date}</small>
                </td>
                <td className="px-6 py-4">
                    {day.condition.name}
                    <small>{day.condition.desc}</small>
                </td>
                <td className="px-6 py-4">
                    {day.datetime.formatted_day} {day.datetime.formatted_date}
                </td>
            </tr>
        };

        return (
            <div>
                <table className='mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
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

export default DayList;