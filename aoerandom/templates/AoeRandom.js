import React from 'react';
import {
    StyleSheet,
    Text, TextInput, TouchableOpacity,
    View,
} from 'react-native';

import {getTeamRandom} from 'aoerandom';

import {Col, Row, Grid} from 'react-native-easy-grid';

export default class AoeRandom extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            teamSize: 8,
            countries: [],
        };
    }

    randomSize() {
        const countries = getTeamRandom(this.state.teamSize);

        this.setState({
            countries: countries,
        });
    }

    render(): React.ReactElement<any> | string | number | {} | React.ReactNodeArray | React.ReactPortal | boolean | null | undefined {
        let rows = this.state.countries.map((country, i) => {
            return (<Row style={styles.row}>
                <Col><Text>{i + 1}</Text></Col>
                <Col><Text>{country}</Text></Col>
            </Row>);
        });

        return (
            <View style={{height: 500, padding: 10}}>
                <View style={styles.addView}>
                    <View style={{flexDirection: 'row', paddingBottom: 10, marginTop: 10}}>
                        <View style={{flex: 1, flexDirection: 'row', alignItems: 'center'}}>
                            <TextInput
                                returnKeyType={'done'}
                                value={this.state.teamSize}
                                onSubmitEditing={() => this.randomSize()}
                                onChangeText={text => this.setState({teamSize: text})}
                                placeholder={'team size'}
                                style={[
                                    {flex: 1},
                                    styles.input,
                                ]}
                            />

                            <TouchableOpacity style={styles.button} onPress={() => this.randomSize()}>
                                <Text style={{color: 'blue'}}>Change</Text>
                            </TouchableOpacity>
                        </View>
                    </View>
                </View>

                <View>
                    <Grid>
                        <Row style={styles.row}>
                            <Col><Text>No</Text></Col>
                            <Col><Text>Country</Text></Col>
                        </Row>
                        {rows}
                    </Grid>
                </View>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    row: {
        padding: 10, height: 40, backgroundColor: 'white'
    },
    wrapper: {
        flex: 1,
        padding: 8,
    },
    addView: {
        paddingHorizontal: 10,
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: 'white',
    },
    input: {
        height: 30,
        padding: 5,
        borderWidth: 1,
        fontSize: 15,
    },
    button: {
        marginLeft: 10,
        borderRadius: 5,
        backgroundColor: '#2196F3',
        padding: 7,
    },
});
