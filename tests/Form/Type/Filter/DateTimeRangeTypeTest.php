<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\AdminBundle\Tests\Form\Type\Filter;

use Sonata\AdminBundle\Form\Type\Filter\DateTimeRangeType;
use Sonata\AdminBundle\Form\Type\Operator\DateRangeOperatorType;
use Sonata\Form\Type\DateTimeRangeType as FormDateTimeRangeType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class DateTimeRangeTypeTest extends BaseTypeTest
{
    public function testDefaultOptions(): void
    {
        $form = $this->factory->create($this->getTestedType());

        $view = $form->createView();

        static::assertFalse($view->children['type']->vars['required']);
        static::assertFalse($view->children['value']->vars['required']);
    }

    public function testGetDefaultOptions(): void
    {
        $type = new DateTimeRangeType();

        $optionsResolver = new OptionsResolver();

        $type->configureOptions($optionsResolver);

        $options = $optionsResolver->resolve();

        $expected = [
            'operator_type' => DateRangeOperatorType::class,
            'field_type' => FormDateTimeRangeType::class,
            'field_options' => ['field_options' => ['date_format' => DateTimeType::HTML5_FORMAT]],
        ];
        static::assertSame($expected, $options);
    }

    protected function getTestedType(): string
    {
        return DateTimeRangeType::class;
    }
}
