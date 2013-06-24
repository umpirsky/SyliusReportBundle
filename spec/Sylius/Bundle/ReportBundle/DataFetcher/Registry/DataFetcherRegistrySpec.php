<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ReportBundle\DataFetcher\Registry;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ReportBundle\DataFetcher\Registry\DataFetcherRegistryInterface;
use Sylius\Bundle\ReportBundle\DataFetcher\DataFetcherInterface;

class DataFetcherRegistrySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ReportBundle\DataFetcher\Registry\DataFetcherRegistry');
    }

    public function it_implements_data_fetcher_registry_interface()
    {
        $this->shouldImplement('Sylius\Bundle\ReportBundle\DataFetcher\Registry\DataFetcherRegistryInterface');
    }

    public function it_initializes_fetchers_array_by_default()
    {
        $this->getFetchers()->shouldReturn(array());
    }

    public function it_registers_fetcher_under_given_type(DataFetcherInterface $fetcher)
    {
        $this->hasFetcher('order')->shouldReturn(false);
        $this->registerFetcher('order', $fetcher);
        $this->hasFetcher('order')->shouldReturn(true);
    }

    public function it_complains_if_trying_to_register_fercher_with_taken_name(DataFetcherInterface $fetcher)
    {
        $this->registerFetcher('order', $fetcher);

        $this
            ->shouldThrow('Sylius\Bundle\ReportBundle\DataFetcher\Registry\ExistingDataFetcherException')
            ->duringRegisterFetcher('order', $fetcher)
        ;
    }

    public function it_unregisters_fetcher_with_given_name(DataFetcherInterface $fetcher)
    {
        $this->registerFetcher('order', $fetcher);
        $this->hasFetcher('order')->shouldReturn(true);

        $this->unregisterFetcher('order');
        $this->hasFetcher('order')->shouldReturn(false);
    }

    public function it_retrieves_registered_fetcher_by_name(DataFetcherInterface $fetcher)
    {
        $this->registerFetcher('order', $fetcher);
        $this->getFetcher('order')->shouldReturn($fetcher);
    }

    public function it_complains_if_trying_to_retrieve_non_existing_fetcher()
    {
        $this
            ->shouldThrow('Sylius\Bundle\ReportBundle\DataFetcher\Registry\NonExistingDataFetcherException')
            ->duringGetFetcher('order')
        ;
    }
}
