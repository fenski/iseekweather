import React, { Component } from "react";
import DayList from "./DayList";

class CitySelect extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            city: '',
            cities: [],
            days: [],
            isLoaded: true,
        };

        // Populate cities list
        // In future add a visual loading state
        fetch("/api/cities/get")
            .then(res => res.json())
            .then(
                (result) => {
                    console.log(result);
                    this.setState({
                        cities: result
                    });
                },
                // Error
                (error) => {
                    this.setState({
                        isLoaded: true,
                        error
                    });
                    // Gross, yes - should be on-screen representation
                    alert('Cities failed to load');
                }
            );

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(event) {
        this.setState( {
            city: event.target.value,
            days: [],
            isLoaded: false,
        });

        // Request data from API
        fetch("/api/forecast/get?cityName="+event.target.value)
            .then(res => res.json())
            .then(
                (result) => {
                    console.log(result);
                    this.setState({
                        isLoaded: true,
                        days: result
                    });
                },
                // Catch errors
                (error) => {
                    this.setState({
                        isLoaded: true,
                        error
                    });
                }
            )

    }

    render() {
        const cityList = this.state.cities.map((city) =>
            <option key={city.name} value={city.name}>{city.name}</option>
        );

        return (
            <div className="pt-4 mx-auto">
                <div className="p-2">
                    <form onSubmit={this.handleSubmit}>
                        <label>
                            <strong>Pick a city:</strong>
                            <select value={this.state.city} onChange={this.handleChange} className="ml-2 border-black">
                                <option key=''>Select a city</option>
                                {cityList}
                            </select>
                        </label>
                    </form>
                </div>

                <div>
                    <DayList days={this.state.days} />
                </div>
            </div>
        );
    }
}

export default CitySelect;