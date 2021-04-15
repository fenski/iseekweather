import React, { Component } from "react";
import DayList from "./DayList";

class CitySelect extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            city: '',
            days: [],
            isLoaded: true,
        };

        // Ugly admission
        // Idea if time to pull these in from the repository
        this.cities = ['Adelaide', 'Brisbane', 'Canberra'];

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(event) {
        // alert(event.target.value);
        this.setState( {
            city: event.target.value,
            days: [],
            isLoaded: false,
        });

        // Request data from API
        fetch("/api/forecast/get?cityName="+this.state.city)
            .then(res => res.json())
            .then(
                (result) => {
                    console.log(result);
                    this.setState({
                        isLoaded: true,
                        days: result
                    });
                },
                // Note: it's important to handle errors here
                // instead of a catch() block so that we don't swallow
                // exceptions from actual bugs in components.
                (error) => {
                    this.setState({
                        isLoaded: true,
                        error
                    });
                }
            )

        // Update view
    }

    handleSubmit(event) {
        alert('Your city is: ' + this.state.city);
        event.preventDefault();
    }

    render() {
        const cityList = this.cities.map((city) =>
            <option key={city} value={city}>{city}</option>
        );

        return (
            <div className="min-h-screen flex items-center px-4">
                <form onSubmit={this.handleSubmit}>
                    <label>
                        Pick a city:
                        <select value={this.state.city} onChange={this.handleChange}>
                            <option key=''></option>
                            {cityList}
                        </select>
                    </label>
                </form>

                <div>
                    <DayList days={this.state.days} />
                </div>
            </div>
        );
    }
}

export default CitySelect;