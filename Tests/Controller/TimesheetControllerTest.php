<?php

namespace Karis\TimesheetBundle\Tests\Controller;

class TimesheetControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/karis/timesheet/timesheet/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /karis/timesheet/timesheet/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'karis_timesheetbundle_timesheet[date][date][year]'  => '2019',
            'karis_timesheetbundle_timesheet[date][date][month]'  => '9',
            'karis_timesheetbundle_timesheet[date][date][day]'  => '19',
            'karis_timesheetbundle_timesheet[date][time][hour]'  => '12',
            'karis_timesheetbundle_timesheet[date][time][minute]'  => '12',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("2019-09-19 12:12:00")')->count(), 'Create: Missing element');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'karis_timesheetbundle_timesheet[date][date][month]'  => '12',
        ));

        $client->submit($form);
        $crawler2 = $client->request('GET', '/karis/timesheet/timesheet/');

        // Check updating data in the show view
        $this->assertGreaterThan(0, $crawler2->filter('td:contains("2019-12-19 12:12:00")')->count(), 'Update: Missing element');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/2019-12-19 12:12:00/', $client->getResponse()->getContent());
    }
}
